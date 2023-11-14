<?php

namespace Synerise\Integration\Event_Queue;


use WC_Data;
use WC_Data_Store;

defined('ABSPATH') || exit;

class Item_Data extends WC_Data
{

    /**
     * This is the name of this object type.
     *
     * @var string
     */
    protected $object_type = 'snrs_event_queue_item';

    /**
     * Synerise Event Queue Item Data array.
     *
     * @var array
     */
    protected $data = array(
        'id' => null,
        'payload' => null,
        'entity_id' => null,
        'event_name' => null,
        'retry_at' => null,
        'retry_count' => null,
    );

    /**
     * Constructor.
     *
     * @param int|object|array $item Event queue item ID.
     */
    public function __construct($item = 0)
    {
        parent::__construct($item);

        if ($item instanceof self) {
            $this->set_id($item->get_id());
        } elseif (is_numeric($item) && $item > 0) {
            $this->set_id($item);
        } elseif (is_object($item) && !empty($item->id)) {
            $this->set_id($item->id);
            $this->set_props((array)$item);
            $this->set_object_read(true);
        } else {
            $this->set_object_read(true);
        }

        $this->data_store = WC_Data_Store::load('synerise-event-queue-item');

        if ($this->get_id() > 0) {
            $this->data_store->read($this);
        }
    }


    /*
    |--------------------------------------------------------------------------
    | Getters
    |--------------------------------------------------------------------------
    */

    /**
     * Set id.
     *
     * @param integer|null $id
     */
    public function set_id($id = null)
    {
        $this->set_prop('id', $id);
    }

    /**
     * Get id.
     *
     * @param string $context Get context.
     * @return string
     */
    public function get_id($context = 'view')
    {
        return $this->get_prop('id', $context);
    }

    /**
     * Get event_name.
     *
     * @param string $context Get context.
     * @return string
     */
    public function get_event_name($context = 'view')
    {
        return $this->get_prop('event_name', $context);
    }

    /**
     * Get payload.
     *
     * @param string $context Get context.
     * @return string
     */
    public function get_payload($context = 'view')
    {
        return json_decode($this->get_prop('payload', $context));
    }

    /**
     * Get entity id.
     *
     * @param string $context Get context.
     * @return integer|null
     */
    public function get_entity_id($context = 'view')
    {
        return $this->get_prop('entity_id', $context);
    }

    /**
     * Get retry at.
     *
     * @param $context
     * @return mixed|null
     */
    public function get_retry_at($context = 'view')
    {
        return $this->get_prop('retry_at', $context);
    }

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    /**
     * Get retry at.
     *
     * @param $context
     * @return mixed|null
     */
    public function get_retry_count($context = 'view')
    {
        return $this->get_prop('retry_count', $context);
    }

    /**
     * Set event name.
     *
     * @param string|null $event_name
     */
    public function set_event_name($event_name = null)
    {
        $this->set_prop('event_name', $event_name);
    }

    /**
     * Set payload.
     *
     * @param array|null $payload
     */
    public function set_payload($payload = null)
    {
        $this->set_prop('payload', json_encode($payload));
    }

    /**
     * Set entity id.
     *
     * @param integer|null $entity_id
     */
    public function set_entity_id($entity_id = null)
    {
        $this->set_prop('entity_id', $entity_id);
    }

    /**
     * Set retry at.
     *
     * @param $retry_at
     */
    public function set_retry_at($retry_at)
    {
        $this->set_prop('retry_at', $retry_at);
    }

    /**
     * set retry count.
     *
     * @param $retry_count
     */
    public function set_retry_count($retry_count)
    {
        $this->set_prop('retry_count', $retry_count);
    }

}