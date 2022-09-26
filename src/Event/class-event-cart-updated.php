<?php

namespace Synerise\Integration\Events;

use Psr\Log\LoggerInterface;
use Synerise\IntegrationCore\Factory\DataManagementApiFactory;
use Synerise\IntegrationCore\Tracking;

if (! defined('ABSPATH')) {
    exit;
}

class Event_Cart_Updated
{
    const HOOK_NAME = 'woocommerce_update_cart_action_cart_updated';
    /**
     * @var Tracking
     */
    private $tracking_manager;
    /**
     * @var DataManagementApiFactory
     */
    private $data_management_api_factory;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(
        LoggerInterface $logger,
        Tracking $tracking_manager,
        DataManagementApiFactory $data_management_api_factory
    ) {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->data_management_api_factory = $data_management_api_factory;
    }

    public function send_event()
    {
        $cart_status_event = new Event_Cart_Status($this->logger, $this->tracking_manager, $this->data_management_api_factory);
        $cart_status_event->send_event();
    }
}
