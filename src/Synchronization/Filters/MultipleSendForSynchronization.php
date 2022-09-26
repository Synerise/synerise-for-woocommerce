<?php

namespace Synerise\Integration\Synchronization\Filters;

use Synerise\Integration\Synchronization\Synchronization;

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class MultipleSendForSynchronization {

    /**
     * @param $redirect_url
     * @param string $action
     * @param array $entity_ids
     * @return mixed|string
     */
    public static function send_for_synchronization($redirect_url, string $action, array $entity_ids)
    {
        $redirect_url_with_params = add_query_arg('send-for-synchronization', count($entity_ids), $redirect_url);
        if ($action == 'send-for-synchronization-product') {
            Synchronization::add_items_to_queue('product', $entity_ids);
        } else if ($action == 'send-for-synchronization-shop_order')  {
	        Synchronization::add_items_to_queue('order', $entity_ids);
        } else {
            return $redirect_url;
        }

        return $redirect_url_with_params;
    }

}