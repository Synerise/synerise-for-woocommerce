<?php

namespace Synerise\Integration\Synchronization;


use WC_Data;
use WC_Data_Store;

defined('ABSPATH') || exit;

class Queue_Data extends WC_Data
{

    /**
     * This is the name of this object type.
     *
     * @var string
     */
    protected $object_type = 'synerise_sync_queue';

    /**
     * Synerise Sync Queue Data array.
     *
     * @var array
     */
    protected $data = array(
        'id' => null,
        'model' => null,
        'entity_id' => null,
    );

    /**
     * Constructor.
     *
     * @param int|object|array $queue Sync queue ID.
     */
    public function __construct($queue = 0)
    {
        parent::__construct($queue);

        if ($queue instanceof self) {
            $this->set_id($queue->get_id());
        } elseif (is_numeric($queue) && $queue > 0) {
            $this->set_id($queue);
        } elseif (is_object($queue) && !empty($queue->id)) {
            $this->set_id($queue->id);
            $this->set_props((array)$queue);
            $this->set_object_read(true);
        } else {
            $this->set_object_read(true);
        }

        $this->data_store = WC_Data_Store::load('synerise-sync-queue');

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
     * Get model.
     *
     * @param string $context Get context.
     * @return string
     */
    public function get_model($context = 'view')
    {
        return $this->get_prop('model', $context);
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

    /*
    |--------------------------------------------------------------------------
    | Setters
    |--------------------------------------------------------------------------
    */

    /**
     * Set model.
     *
     * @param string|null $model
     */
    public function set_model($model = null)
    {
        $this->set_prop('model', $model);
    }

    /**
     * Set start id.
     *
     * @param integer|null $start_id
     */
    public function set_entity_id($start_id = null)
    {
        $this->set_prop('entity_id', $start_id);
    }

}