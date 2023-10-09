<?php

namespace Synerise\Integration\Synchronization;

use Synerise\DataManagement\ApiException;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Synchronization\DataStore\Status_Data_Store;
use Synerise\Integration\Synerise_For_Woocommerce;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Synchronization {

    const ACTION_SYNC_BY_ID     = SYNERISE_FOR_WOOCOMMERCE_PREFIX . '-sync-by-id';
    const ACTION_SYNC_BY_QUEUE  = SYNERISE_FOR_WOOCOMMERCE_PREFIX . '-sync-by-queue';

    private $logger;

    public function __construct()
    {
        $this->logger = Synerise_For_Woocommerce::get_logger();
    }

    public static function sync_by_id() {
        try {
            /** @var DataStore\Status_Data_Store $data_store */
            $data_store = \WC_Data_Store::load( 'synerise-sync-status' );

            $statuses = $data_store->get_sync_statuses([
                'state' => Status_Data::STATE_IN_PROGRESS
            ]);

            /** @var Status_Data $status */
            foreach ($statuses as $status) {
                $scheduler = self::get_scheduler($status->get_model());

                if (!$scheduler || !$scheduler->is_enabled()) {
                    continue;
                }

                $stop_id = $status->get_stop_id() ?? $scheduler->get_current_last_id();

				if($stop_id === 0){
					$stop_id = $scheduler->get_current_last_id();
				}

                $status->set_stop_id($stop_id);

                $collection = $scheduler->get_collection_filtered_by_id_range(
                    $status->get_start_id(),
                    $stop_id,
                    Synerise_For_Woocommerce::get_setting('synchronization_updates_synchronization_page_size')
                );


                if (empty($collection)) {
                    continue;
                }

                sort($collection);

                try {
                    $scheduler->send_items($collection);
                } catch (ApiException $e) {
                    Synerise_For_Woocommerce::get_logger()->error(
                        "[{$e->getCode()}] Failed to process queue item. Response Body: " . $e->getResponseBody()
                    );
                } catch (\Exception $e) {
                     (new Synchronization)->logger->error(Logger_Service::addExceptionToMessage('Failed to send cron items', $e));
                }

                $status->set_start_id(end($collection));
                if ($status->get_start_id() == $status->get_stop_id()) {
                    $status->set_state(Status_Data::STATE_COMPLETE);
                }

                $status->save();
            }
        } catch (\Exception $e) {
            (new Synchronization)->logger->error(Logger_Service::addExceptionToMessage('Failed to process cron items', $e));
        }
    }

    public static function sync_by_queue() {
        try {
            /** @var DataStore\Queue_Data_Store $data_store */
            $data_store = \WC_Data_Store::load( 'synerise-sync-queue' );

            /** @var Queue_Data[] $queue_items */
            $queue_items = $data_store->get_queue_items([
                'limit' => Synerise_For_Woocommerce::get_setting('synchronization_data_synchronization_page_size')
            ]);

            if(empty($queue_items)){
                return;
            }

            $group_by_scheduler = [];
            foreach($queue_items as $item){
	            $group_by_scheduler[$item->get_model()][] = $item;
            }

            foreach($group_by_scheduler as $scheduler_name => $scheduler_queue_items){
                $scheduler = self::get_scheduler($scheduler_name);

                if (!$scheduler || !$scheduler->is_enabled()) {
                    continue;
                }

                $entity_ids = array_map(function($e) {
                    return is_object($e) ? $e->get_entity_id() : $e['entity_id'];
                }, $scheduler_queue_items);


                $scheduler->send_items($entity_ids);
            }

            self::delete_items_from_queue($queue_items);

        } catch (\Exception $e) {
            (new Synchronization)->logger->error(Logger_Service::addExceptionToMessage('Failed to process cron items', $e));
        }
    }

    public static function create_cron_jobs() {
	    if ( false === as_has_scheduled_action( self::ACTION_SYNC_BY_QUEUE ) ) {
		    as_schedule_cron_action(
			    time(),
			    Synerise_For_Woocommerce::get_setting( 'synchronization_data_synchronization_cron_expression' ),
			    self::ACTION_SYNC_BY_QUEUE,
			    [],
			    SYNERISE_FOR_WOOCOMMERCE_PREFIX
		    );
	    }

	    if ( false === as_has_scheduled_action( self::ACTION_SYNC_BY_ID ) ) {
            as_schedule_cron_action(
	            time(),
	            Synerise_For_Woocommerce::get_setting('synchronization_updates_synchronization_cron_expression'),
	            self::ACTION_SYNC_BY_ID,
	            [],
	            SYNERISE_FOR_WOOCOMMERCE_PREFIX
	        );
	    }
    }

	public static function add_item_to_queue($model, $entity_id)
    {
        /** @var DataStore\Queue_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-sync-queue' );
        $queue_item = new Queue_Data();
	    $queue_item->set_model($model);
	    $queue_item->set_entity_id($entity_id);
        $data_store->create($queue_item);
    }

    public static function add_items_to_queue($model, $entity_ids)
    {
        /** @var DataStore\Queue_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-sync-queue' );
        $queue_items = array();
        foreach ($entity_ids as $entity_id){
            $queue_item = new Queue_Data();
	        $queue_item->set_model($model);
	        $queue_item->set_entity_id($entity_id);
	        $queue_items[] = $queue_item;
        }

        $data_store->create_multiple($queue_items);
    }

	/**
	 * @throws \Exception
	 * @var Queue_Data[] $queue_items
	 */
    public static function delete_items_from_queue(array $queue_items)
    {
        $queue_items_ids = array_map(function($e) {
            return is_object($e) ? $e->get_id() : $e['id'];
        }, $queue_items);

        /** @var DataStore\Queue_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-sync-queue' );
        $data_store->delete_multiple($queue_items_ids);
    }

    public static function resend_items($model)
    {
        /** @var DataStore\Status_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-sync-status' );

        /** @var Status_Data $status */
        $status = $data_store->get_sync_status_by_model(['model' => $model]);
        $status->set_start_id();
        $status->set_stop_id();
        $status->set_state(Status_Data::STATE_IN_PROGRESS);
        $status->save();

        /** @var DataStore\History_Data_Store $history_store */
        $history_store = \WC_Data_Store::load( 'synerise-sync-history' );
        $history_store->delete_by(['model' => $model]);
    }

	public static function reset_sync_status($model)
	{
		/** @var Status_Data_Store $data_store */
		$data_store = \WC_Data_Store::load( 'synerise-sync-status' );
		$status = $data_store->get_sync_status_by_model(['model' => $model]);
		$status->set_stop_id();
		$status->set_state(Status_Data::STATE_IN_PROGRESS);
		$status->save();
	}

    /**
     * @param string $model
     * @return Scheduler\Abstract_Scheduler|null
     */
    private static function get_scheduler(string $model)
    {
        if($model == 'customer') {
            return new Scheduler\Customer_Scheduler(
                Synerise_For_Woocommerce::get_logger(),
                Synerise_For_Woocommerce::get_client_management_api_factory()
            );
        } elseif ($model == 'product') {
            return new Scheduler\Product_Scheduler(
                Synerise_For_Woocommerce::get_logger(),
                Synerise_For_Woocommerce::get_data_management_catalogs_api_factory()
            );
        } elseif ($model == 'order') {
            return new Scheduler\Order_Scheduler(
                Synerise_For_Woocommerce::get_logger(),
                Synerise_For_Woocommerce::get_data_management_api_factory()
            );
        }

        return null;
    }
}
