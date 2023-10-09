<?php
/**
 * TransactionsProducts
 *
 * PHP version 5
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * Data Management
 *
 * Welcome to Synerise API Reference! We hope that you'll enjoy your stay here.  If you need help with our services, feel free to contact us at  [support@synerise.com](mailto:support@synerise.com).  # Authentication  <!-- ReDoc-Inject: <security-definitions> -->
 *
 * OpenAPI spec version: Jul 4, 2022 12:12:40 PM
 * 
 * Generated by: https://github.com/swagger-api/swagger-codegen.git
 * Swagger Codegen version: 3.0.34
 */
/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Synerise\DataManagement\Model;

use \ArrayAccess;
use \Synerise\DataManagement\ObjectSerializer;

/**
 * TransactionsProducts Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class TransactionsProducts implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'transactions_products';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'cancel' => 'bool',
'final_unit_price' => '\Synerise\DataManagement\Model\TransactionsFinalUnitPrice',
'name' => 'string',
'net_unit_price' => '\Synerise\DataManagement\Model\TransactionsNetUnitPrice',
'quantity' => 'float',
'regular_price' => '\Synerise\DataManagement\Model\TransactionsRegularPrice',
'sku' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'cancel' => null,
'final_unit_price' => null,
'name' => null,
'net_unit_price' => null,
'quantity' => null,
'regular_price' => null,
'sku' => null    ];

    /**
     * Array of property to type mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    /**
     * Array of property to format mappings. Used for (de)serialization
     *
     * @return array
     */
    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @var string[]
     */
    protected static $attributeMap = [
        'cancel' => 'cancel',
'final_unit_price' => 'finalUnitPrice',
'name' => 'name',
'net_unit_price' => 'netUnitPrice',
'quantity' => 'quantity',
'regular_price' => 'regularPrice',
'sku' => 'sku'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'cancel' => 'setCancel',
'final_unit_price' => 'setFinalUnitPrice',
'name' => 'setName',
'net_unit_price' => 'setNetUnitPrice',
'quantity' => 'setQuantity',
'regular_price' => 'setRegularPrice',
'sku' => 'setSku'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'cancel' => 'getCancel',
'final_unit_price' => 'getFinalUnitPrice',
'name' => 'getName',
'net_unit_price' => 'getNetUnitPrice',
'quantity' => 'getQuantity',
'regular_price' => 'getRegularPrice',
'sku' => 'getSku'    ];

    /**
     * Array of attributes where the key is the local name,
     * and the value is the original name
     *
     * @return array
     */
    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @return array
     */
    public static function setters()
    {
        return self::$setters;
    }

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @return array
     */
    public static function getters()
    {
        return self::$getters;
    }

    /**
     * The original name of the model.
     *
     * @return string
     */
    public function getModelName()
    {
        return self::$swaggerModelName;
    }

    

    /**
     * Associative array for storing property values
     *
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     *
     * @param mixed[] $data Associated array of property values
     *                      initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['cancel'] = isset($data['cancel']) ? $data['cancel'] : null;
        $this->container['final_unit_price'] = isset($data['final_unit_price']) ? $data['final_unit_price'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['net_unit_price'] = isset($data['net_unit_price']) ? $data['net_unit_price'] : null;
        $this->container['quantity'] = isset($data['quantity']) ? $data['quantity'] : null;
        $this->container['regular_price'] = isset($data['regular_price']) ? $data['regular_price'] : null;
        $this->container['sku'] = isset($data['sku']) ? $data['sku'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['final_unit_price'] === null) {
            $invalidProperties[] = "'final_unit_price' can't be null";
        }
        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['quantity'] === null) {
            $invalidProperties[] = "'quantity' can't be null";
        }
        if ($this->container['sku'] === null) {
            $invalidProperties[] = "'sku' can't be null";
        }
        return $invalidProperties;
    }

    /**
     * Validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {
        return count($this->listInvalidProperties()) === 0;
    }


    /**
     * Gets cancel
     *
     * @return bool
     */
    public function getCancel()
    {
        return $this->container['cancel'];
    }

    /**
     * Sets cancel
     *
     * @param bool $cancel Set to `false` to mark an item that was cancelled from the purchase
     *
     * @return $this
     */
    public function setCancel($cancel)
    {
        $this->container['cancel'] = $cancel;

        return $this;
    }

    /**
     * Gets final_unit_price
     *
     * @return \Synerise\DataManagement\Model\TransactionsFinalUnitPrice
     */
    public function getFinalUnitPrice()
    {
        return $this->container['final_unit_price'];
    }

    /**
     * Sets final_unit_price
     *
     * @param \Synerise\DataManagement\Model\TransactionsFinalUnitPrice $final_unit_price final_unit_price
     *
     * @return $this
     */
    public function setFinalUnitPrice($final_unit_price)
    {
        $this->container['final_unit_price'] = $final_unit_price;

        return $this;
    }

    /**
     * Gets name
     *
     * @return string
     */
    public function getName()
    {
        return $this->container['name'];
    }

    /**
     * Sets name
     *
     * @param string $name Name of the product
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets net_unit_price
     *
     * @return \Synerise\DataManagement\Model\TransactionsNetUnitPrice
     */
    public function getNetUnitPrice()
    {
        return $this->container['net_unit_price'];
    }

    /**
     * Sets net_unit_price
     *
     * @param \Synerise\DataManagement\Model\TransactionsNetUnitPrice $net_unit_price net_unit_price
     *
     * @return $this
     */
    public function setNetUnitPrice($net_unit_price)
    {
        $this->container['net_unit_price'] = $net_unit_price;

        return $this;
    }

    /**
     * Gets quantity
     *
     * @return float
     */
    public function getQuantity()
    {
        return $this->container['quantity'];
    }

    /**
     * Sets quantity
     *
     * @param float $quantity The number or amount of purchased items
     *
     * @return $this
     */
    public function setQuantity($quantity)
    {
        $this->container['quantity'] = $quantity;

        return $this;
    }

    /**
     * Gets regular_price
     *
     * @return \Synerise\DataManagement\Model\TransactionsRegularPrice
     */
    public function getRegularPrice()
    {
        return $this->container['regular_price'];
    }

    /**
     * Sets regular_price
     *
     * @param \Synerise\DataManagement\Model\TransactionsRegularPrice $regular_price regular_price
     *
     * @return $this
     */
    public function setRegularPrice($regular_price)
    {
        $this->container['regular_price'] = $regular_price;

        return $this;
    }

    /**
     * Gets sku
     *
     * @return string
     */
    public function getSku()
    {
        return $this->container['sku'];
    }

    /**
     * Sets sku
     *
     * @param string $sku SKU of the item
     *
     * @return $this
     */
    public function setSku($sku)
    {
        $this->container['sku'] = $sku;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     *
     * @param integer $offset Offset
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     *
     * @param integer $offset Offset
     *
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     *
     * @param integer $offset Offset
     * @param mixed   $value  Value to be set
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    /**
     * Unsets offset.
     *
     * @param integer $offset Offset
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     *
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(
                ObjectSerializer::sanitizeForSerialization($this),
                JSON_PRETTY_PRINT
            );
        }

        return json_encode(ObjectSerializer::sanitizeForSerialization($this));
    }
}
