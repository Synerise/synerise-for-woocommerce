<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Logger_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synchronization\Synchronization;
use WC_Product;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Product_Import
{
    const HOOK_NAME = 'woocommerce_product_import_inserted_product_object';
	const EVENT_NAME = 'product_import';

    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger
    ) {
        $this->logger = $logger;
    }

    public function send_event(WC_Product $product)
    {
        if (!Tracking_Service::is_event_enabled(self::EVENT_NAME)) {
            return;
        }

	    if(empty($product->get_sku())){
		    return;
	    }

        try {
            Synchronization::add_item_to_queue('product', $product->get_id());
        } catch (\Exception $e) {
            $this->logger->error(Logger_Service::addExceptionToMessage('Failed to add product to cron queue', $e));
        }
    }
}
