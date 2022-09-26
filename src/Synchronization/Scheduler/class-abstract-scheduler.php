<?php

namespace Synerise\Integration\Synchronization\Scheduler;

use Synerise\Integration\Synchronization\DataStore\History_Data_Store;
use Synerise\Integration\Synchronization\History;
use Synerise\Integration\Synchronization\History_Data;

abstract class Abstract_Scheduler
{

    abstract public function send_items(array $collection);

    abstract public function get_collection_filtered_by_id_range($start_id, $stop_id, $page_size);

    abstract public function get_current_last_id();

    abstract public function is_enabled(): bool;

    public function mark_items_as_sent($entity_ids)
    {
        /** @var History_Data_Store $data_store */
        $data_store = \WC_Data_Store::load( 'synerise-sync-history' );

        $history_items = array();
        foreach ($entity_ids as $entity_id){
            $history_item = new History_Data();
	        $history_item->set_model(static::MODEL);
	        $history_item->set_entity_id($entity_id);
            $history_items[] = $history_item;
        }

        $data_store->createMultiple($history_items);
    }
}
