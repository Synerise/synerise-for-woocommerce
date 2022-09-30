<?php

namespace Synerise\Integration\Synchronization\Scheduler;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Uuid;
use Synerise\Integration\Service\Order_Service;

class Order_Scheduler extends Abstract_Scheduler
{
    const MODEL = 'order';
    const ENTITY_ID = 'entity_id';

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;

    public function __construct(
        LoggerInterface $logger,
        DataManagementApiFactory $data_management_api_factory
    ) {
        $this->logger = $logger;
        $this->data_management_api_factory = $data_management_api_factory;
    }

    public function send_items(array $collection)
    {
        if (empty($collection)) {
            return;
        }

	    $transactions_body = [];
        $ids = [];
        foreach ($collection as $order_id) {
            $order = new \WC_Order($order_id);

            $action_data = [
                'client' => [
                    'uuid' => Uuid::generateUuidByEmail($order->get_billing_email()),
                ]
            ];

            $transaction_body = array_merge($action_data, Order_Service::prepare_order_params($order));
            $transactions_body[] = $transaction_body;
            $ids[] = $order_id;
        }

        if(!empty($transactions_body)) {
            $response_code = $this->send_orders_to_synerise(\GuzzleHttp\json_encode($transactions_body));
            $this->mark_items_as_sent($ids);

			return $response_code;
        }
    }

	/**
	 * @param $add_or_update_transactions_body
	 */
    public function send_orders_to_synerise($add_or_update_transactions_body)
    {
        try {
	        list($body, $status_code, $headers) = $this->data_management_api_factory->create()
                ->batchAddOrUpdateTransactionsWithHttpInfo($add_or_update_transactions_body, '4.4');
            return $status_code;
		} catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
            throw $e;
        }
    }

	/**
	 * @param $start_id
	 * @param $stop_id
	 * @param $page_size
	 *
	 * @return array
	 */
    public function get_collection_filtered_by_id_range($start_id, $stop_id, $page_size): array
    {
        global $wpdb;

	    $table_name = $wpdb->prefix. 'posts';
	    $sql = $wpdb->prepare("SELECT ID FROM {$table_name} WHERE ID <= %d AND ID > %d AND post_type = 'shop_order' ORDER BY ID ASC LIMIT %d", [$stop_id, $start_id, $page_size]);
        return $wpdb->get_col($sql);
    }

    /**
     * @return string|null
     */
    public function get_current_last_id()
    {
        global $wpdb;
		$table_name = $wpdb->prefix. 'posts';
        return $wpdb->get_var("SELECT ID FROM {$table_name} WHERE post_type = 'shop_order' ORDER BY ID DESC LIMIT 1");
    }

    public function is_enabled(): bool
    {
        return (bool) Synerise_For_Woocommerce::get_setting('data_orders_enabled');
    }

}
