<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Product_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synchronization\Synchronization;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Product_Added
{
    const HOOK_NAME = 'woocommerce_update_product';
	const EVENT_NAME = 'product_update';

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function send_event(int $product_id)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

        if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
            return;
        }

        try {
			$product = wc_get_product($product_id);

			if(empty(Product_Service::get_item_key($product))){
				return;
			}

            Synchronization::add_item_to_queue('product', $product_id);

            $wp_query = new \WP_Query([
                'post_parent' => $product->get_id(),
                'post_type' => 'product_variation',
                'post_status' => get_post_stati()
            ]);

            $product_variations = wp_list_pluck( $wp_query->posts, 'ID' );

            foreach ($product_variations as $product_variation){
                Synchronization::add_item_to_queue('product', $product_variation);
            }

        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Api request failed', $e));
        }
    }
}
