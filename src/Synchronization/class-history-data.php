<?php

namespace Synerise\Integration\Synchronization;


use DateTime;
use WC_Data;
use WC_Data_Store;

defined('ABSPATH') || exit;

class History_Data extends WC_Data
{

    /**
     * This is the name of this object type.
     *
     * @var string
     */
    protected $object_type = 'synerise_sync_history';

    /**
     * Synerise Sync History Data array.
     *
     * @var array
     */
    protected $data = array(
        'id' => null,
        'model' => null,
        'entity_id' => null,
        'synerise_updated_at' => null,
    );

    /**
     * Constructor.
     *
     * @param int|object|array $histories Sync history ID.
     */
    public function __construct($history = 0)
    {
        parent::__construct($history);

        if ($history instanceof self) {
            $this->set_id($history->get_id());
        } elseif (is_numeric($history) && $history > 0) {
            $this->set_id($history);
        } elseif (is_object($history) && !empty($history->id)) {
            $this->set_id($history->id);
            $this->set_props((array)$history);
            $this->set_object_read(true);
        } else {
            $this->set_object_read(true);
        }

        $this->data_store = WC_Data_Store::load('synerise-sync-history');

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

    /**
     * Get synerise_updated_at.
     *
     * @param string $context Get context.
     */
    public function get_synerise_updated_at($context = 'view')
    {
        return $this->get_prop('synerise_updated_at', $context);
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
     * Set entity id.
     *
     * @param integer|null $entity_id
     */
    public function set_entity_id($entity_id = null)
    {
        $this->set_prop('entity_id', $entity_id);
    }

    /**
     * Set entity id.
     *
     * @param DateTime|null $synerise_updated_at
     */
    public function set_synerise_updated_at($synerise_updated_at = null)
    {
        $this->set_prop('synerise_updated_at', $synerise_updated_at);
    }

}