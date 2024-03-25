<?php

namespace Synerise\Integration\Event;

use Psr\Log\LoggerInterface;
use Synerise\Integration\Event_Queue\Item_Data;
use Synerise\Integration\Event_Queue\Item_Data_Store;
use Synerise\Integration\Service\Event_Service;
use Synerise\Integration\Service\Tracking_Service;
use Synerise\Integration\Synerise_For_Woocommerce;
use Synerise\IntegrationCore\Tracking;
use WC_Data_Store;


if (!defined('ABSPATH')) {
    exit;
}

abstract class Abstract_Event
{
    const EVENT_NAME = '';
    /**
     * @var Tracking
     */
    protected $tracking_manager;

    /**
     * @var Event_Service
     */
    protected $event_service;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    public function __construct(
        LoggerInterface $logger,
        Tracking        $tracking_manager,
        Event_Service   $event_service
    )
    {
        $this->logger = $logger;
        $this->tracking_manager = $tracking_manager;
        $this->event_service = $event_service;
    }

    public function is_event_enabled()
    {
        return Tracking_Service::is_event_enabled($this->get_event_name());
    }

    protected function should_include_snrs_params()
    {
        return Tracking_Service::should_include_snrs_params();
    }

    public function get_event_name()
    {
        return static::EVENT_NAME;
    }

    protected function process_event($payload, $entity_id = null)
    {
        $event_name = $this->get_event_name();

        if ($this->is_queue_enabled()) {
            $this->publish_event($event_name, $payload, $entity_id);
        } else {
            $this->send_event($event_name, $payload, $entity_id);
        }
    }

    private function is_queue_enabled()
    {
        return (bool)Synerise_For_Woocommerce::get_setting('event_tracking_queue_enabled');
    }

    public function publish_event(string $event_name, $payload, $entity_id = null)
    {
        /** @var Item_Data_Store $data_store */
        $data_store = WC_Data_Store::load('synerise-event-queue-item');
        $queue_item = new Item_Data();
        $queue_item->set_event_name($event_name);
        $queue_item->set_payload($payload);
        $queue_item->set_entity_id($entity_id);
        $data_store->create($queue_item);
        return $queue_item;
    }

    public function send_event(string $event_name, $payload, $entity_id = null)
    {
        return $this->event_service->send_event($event_name, $payload, $entity_id);
    }

    protected function process_client_update($payload, $entity_id = null)
    {
        if ($this->is_queue_enabled()) {
            $this->publish_event('ADD_OR_UPDATE_CLIENT', $payload, $entity_id);
        } else {
            $this->send_event('ADD_OR_UPDATE_CLIENT', $payload, $entity_id);
        }
    }
}
