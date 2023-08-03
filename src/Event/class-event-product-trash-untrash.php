<?php

namespace Synerise\Integration\Event;

use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Product_Service;

if (! defined('ABSPATH')) {
	exit;
}

class Event_Product_Trash_Untrash extends Abstract_Event
{
	const EVENT_NAME = 'product_trash_untrash';

	public function execute($post_id)
	{
        if (!$this->is_event_enabled()) {
            return null;
        }

		$post = get_post($post_id);
		if(is_null($post) || strpos($post->post_type, 'product') === false){
			return null;
		}

		/**
		 * @var \WC_Product $product
		 */
		$product = wc_get_product($post_id);
		if(empty(Product_Service::get_item_key($product))){
			return null;
		}

		try {
            $this->process_event($this->prepare_event($product));
		} catch (\Exception $e) {
                $this->logger->error(Logger_Service::addExceptionToMessage('Synerise Event processing failed', $e));
		}
	}

    public function prepare_event($product)
    {
        return \GuzzleHttp\json_encode(Product_Service::prepare_items($product));
    }
}
