<?php

namespace Synerise\Integration\Synchronization;


use WC_Data;
use WC_Data_Store;

defined('ABSPATH') || exit;

class Status_Data extends WC_Data
{

    const STATE_IN_PROGRESS = 0;
    const STATE_COMPLETE = 1;

    /**
     * This is the name of this object type.
     *
     * @var string
     */
    protected $object_type = 'synerise_sync_status';

    /**
     * Synerise Sync Status Data array.
     *
     * @var array
     */
    protected $data = array(
        'id' => null,
        'model' => null,
        'start_id' => null,
        'stop_id' => null,
        'state' => 0,
        'attempts' => 0,
        'retry_at' => null
    );

    /**
     * Constructor.
     *
     * @param int|object|array $status Sync status ID.
     */
    public function __construct($status = 0)
    {
        parent::__construct($status);

        if ($status instanceof self) {
            $this->set_id($status->get_id());
        } elseif (is_numeric($status) && $status > 0) {
            $this->set_id($status);
        } elseif (is_object($status) && !empty($status->id)) {
            $this->set_id($status->id);
            $this->set_props((array)$status);
            $this->set_object_read(true);
        } else {
            $this->set_object_read(true);
        }

        $this->data_store = WC_Data_Store::load('synerise-sync-status');

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
     * Get start id.
     *
     * @param string $context Get context.
     * @return integer|null
     */
    public function get_start_id($context = 'view')
    {
        return $this->get_prop('start_id', $context);
    }

    /**
     * Get stop id.
     *
     * @param string $context Get context.
     * @return integer|null
     */
    public function get_stop_id($context = 'view')
    {
        return $this->get_prop('stop_id', $context);
    }

    /**
     * Get state.
     *
     * @param string $context Get context.
     * @return integer|null
     */
    public function get_state($context = 'view')
    {
        return $this->get_prop('state', $context);
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
    public function set_start_id($start_id = null)
    {
        $this->set_prop('start_id', (int)$start_id);
    }

    /**
     * Set stop id.
     *
     * @param integer|null $stop_id
     */
    public function set_stop_id($stop_id = null)
    {
        $this->set_prop('stop_id', (int)$stop_id);
    }

    /**
     * Set state.
     *
     * @param integer|null $state
     */
    public function set_state($state = null)
    {
        $this->set_prop('state', $state);
    }

}