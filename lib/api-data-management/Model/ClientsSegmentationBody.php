<?php
/**
 * ClientsSegmentationBody
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
 * ClientsSegmentationBody Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ClientsSegmentationBody implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'clients_segmentation_body';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'name' => 'string',
'fields' => 'string[]',
'agreement_filter' => 'string',
'segmentation_hash' => 'string',
'expressions' => 'string[]',
'aggregates' => 'string[]',
'excluded_ids' => 'int[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'name' => null,
'fields' => null,
'agreement_filter' => null,
'segmentation_hash' => null,
'expressions' => null,
'aggregates' => null,
'excluded_ids' => null    ];

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
        'name' => 'name',
'fields' => 'fields',
'agreement_filter' => 'agreementFilter',
'segmentation_hash' => 'segmentationHash',
'expressions' => 'expressions',
'aggregates' => 'aggregates',
'excluded_ids' => 'excludedIds'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'name' => 'setName',
'fields' => 'setFields',
'agreement_filter' => 'setAgreementFilter',
'segmentation_hash' => 'setSegmentationHash',
'expressions' => 'setExpressions',
'aggregates' => 'setAggregates',
'excluded_ids' => 'setExcludedIds'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'name' => 'getName',
'fields' => 'getFields',
'agreement_filter' => 'getAgreementFilter',
'segmentation_hash' => 'getSegmentationHash',
'expressions' => 'getExpressions',
'aggregates' => 'getAggregates',
'excluded_ids' => 'getExcludedIds'    ];

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

    const AGREEMENT_FILTER_NONE = 'NONE';
const AGREEMENT_FILTER_RECOGNIZED = 'RECOGNIZED';
const AGREEMENT_FILTER_ANONYMOUS = 'ANONYMOUS';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getAgreementFilterAllowableValues()
    {
        return [
            self::AGREEMENT_FILTER_NONE,
self::AGREEMENT_FILTER_RECOGNIZED,
self::AGREEMENT_FILTER_ANONYMOUS,        ];
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
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['fields'] = isset($data['fields']) ? $data['fields'] : null;
        $this->container['agreement_filter'] = isset($data['agreement_filter']) ? $data['agreement_filter'] : null;
        $this->container['segmentation_hash'] = isset($data['segmentation_hash']) ? $data['segmentation_hash'] : null;
        $this->container['expressions'] = isset($data['expressions']) ? $data['expressions'] : null;
        $this->container['aggregates'] = isset($data['aggregates']) ? $data['aggregates'] : null;
        $this->container['excluded_ids'] = isset($data['excluded_ids']) ? $data['excluded_ids'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['name'] === null) {
            $invalidProperties[] = "'name' can't be null";
        }
        if ($this->container['fields'] === null) {
            $invalidProperties[] = "'fields' can't be null";
        }
        if ($this->container['agreement_filter'] === null) {
            $invalidProperties[] = "'agreement_filter' can't be null";
        }
        $allowedValues = $this->getAgreementFilterAllowableValues();
        if (!is_null($this->container['agreement_filter']) && !in_array($this->container['agreement_filter'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'agreement_filter', must be one of '%s'",
                implode("', '", $allowedValues)
            );
        }

        if ($this->container['segmentation_hash'] === null) {
            $invalidProperties[] = "'segmentation_hash' can't be null";
        }
        if ($this->container['excluded_ids'] === null) {
            $invalidProperties[] = "'excluded_ids' can't be null";
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
     * @param string $name The name of the export
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets fields
     *
     * @return string[]
     */
    public function getFields()
    {
        return $this->container['fields'];
    }

    /**
     * Sets fields
     *
     * @param string[] $fields An array of fields from the profile to include in the export
     *
     * @return $this
     */
    public function setFields($fields)
    {
        $this->container['fields'] = $fields;

        return $this;
    }

    /**
     * Gets agreement_filter
     *
     * @return string
     */
    public function getAgreementFilter()
    {
        return $this->container['agreement_filter'];
    }

    /**
     * Sets agreement_filter
     *
     * @param string $agreement_filter Filter exported clients by status: only anonymous, only recognized, or no filter
     *
     * @return $this
     */
    public function setAgreementFilter($agreement_filter)
    {
        $allowedValues = $this->getAgreementFilterAllowableValues();
        if (!in_array($agreement_filter, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'agreement_filter', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['agreement_filter'] = $agreement_filter;

        return $this;
    }

    /**
     * Gets segmentation_hash
     *
     * @return string
     */
    public function getSegmentationHash()
    {
        return $this->container['segmentation_hash'];
    }

    /**
     * Sets segmentation_hash
     *
     * @param string $segmentation_hash Segmentation (UUID) to export clients from
     *
     * @return $this
     */
    public function setSegmentationHash($segmentation_hash)
    {
        $this->container['segmentation_hash'] = $segmentation_hash;

        return $this;
    }

    /**
     * Gets expressions
     *
     * @return string[]
     */
    public function getExpressions()
    {
        return $this->container['expressions'];
    }

    /**
     * Sets expressions
     *
     * @param string[] $expressions An array of expressions (expression UUIDs) whose results will be included in the export. In the export results, the result of the analysis is identified by the UUID.
     *
     * @return $this
     */
    public function setExpressions($expressions)
    {
        $this->container['expressions'] = $expressions;

        return $this;
    }

    /**
     * Gets aggregates
     *
     * @return string[]
     */
    public function getAggregates()
    {
        return $this->container['aggregates'];
    }

    /**
     * Sets aggregates
     *
     * @param string[] $aggregates An array of aggregates (aggregate UUIDs) whose results will be included in the export. In the export results, the result of the analysis is identified by the UUID.
     *
     * @return $this
     */
    public function setAggregates($aggregates)
    {
        $this->container['aggregates'] = $aggregates;

        return $this;
    }

    /**
     * Gets excluded_ids
     *
     * @return int[]
     */
    public function getExcludedIds()
    {
        return $this->container['excluded_ids'];
    }

    /**
     * Sets excluded_ids
     *
     * @param int[] $excluded_ids Necessary for backwards compatibility. Send empty array.
     *
     * @return $this
     */
    public function setExcludedIds($excluded_ids)
    {
        $this->container['excluded_ids'] = $excluded_ids;

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
