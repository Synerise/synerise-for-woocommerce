<?php

namespace Synerise\Integration\Events;

use Psr\Log\LoggerInterface;
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

        try {
			$product = wc_get_product($product_id);

			if(empty($product->get_sku())){
				return;
			}

            Synchronization::add_item_to_queue('product', $product_id);
        } catch (\Exception $e) {
			$this->logger->error('Failed to add product to cron queue', ['exception' => $e]);
        }
    }
}
