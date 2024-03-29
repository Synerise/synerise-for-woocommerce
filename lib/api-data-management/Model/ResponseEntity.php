<?php
/**
 * ResponseEntity
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
 * ResponseEntity Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class ResponseEntity implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'ResponseEntity';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'body' => 'object',
'status_code' => 'string',
'status_code_value' => 'int'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'body' => null,
'status_code' => null,
'status_code_value' => 'int32'    ];

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
        'body' => 'body',
'status_code' => 'statusCode',
'status_code_value' => 'statusCodeValue'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'body' => 'setBody',
'status_code' => 'setStatusCode',
'status_code_value' => 'setStatusCodeValue'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'body' => 'getBody',
'status_code' => 'getStatusCode',
'status_code_value' => 'getStatusCodeValue'    ];

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

    const STATUS_CODE__100 = '100';
const STATUS_CODE__101 = '101';
const STATUS_CODE__102 = '102';
const STATUS_CODE__103 = '103';
const STATUS_CODE__200 = '200';
const STATUS_CODE__201 = '201';
const STATUS_CODE__202 = '202';
const STATUS_CODE__203 = '203';
const STATUS_CODE__204 = '204';
const STATUS_CODE__205 = '205';
const STATUS_CODE__206 = '206';
const STATUS_CODE__207 = '207';
const STATUS_CODE__208 = '208';
const STATUS_CODE__226 = '226';
const STATUS_CODE__300 = '300';
const STATUS_CODE__301 = '301';
const STATUS_CODE__302 = '302';
const STATUS_CODE__303 = '303';
const STATUS_CODE__304 = '304';
const STATUS_CODE__305 = '305';
const STATUS_CODE__307 = '307';
const STATUS_CODE__308 = '308';
const STATUS_CODE__400 = '400';
const STATUS_CODE__401 = '401';
const STATUS_CODE__402 = '402';
const STATUS_CODE__403 = '403';
const STATUS_CODE__404 = '404';
const STATUS_CODE__405 = '405';
const STATUS_CODE__406 = '406';
const STATUS_CODE__407 = '407';
const STATUS_CODE__408 = '408';
const STATUS_CODE__409 = '409';
const STATUS_CODE__410 = '410';
const STATUS_CODE__411 = '411';
const STATUS_CODE__412 = '412';
const STATUS_CODE__413 = '413';
const STATUS_CODE__414 = '414';
const STATUS_CODE__415 = '415';
const STATUS_CODE__416 = '416';
const STATUS_CODE__417 = '417';
const STATUS_CODE__418 = '418';
const STATUS_CODE__419 = '419';
const STATUS_CODE__420 = '420';
const STATUS_CODE__421 = '421';
const STATUS_CODE__422 = '422';
const STATUS_CODE__423 = '423';
const STATUS_CODE__424 = '424';
const STATUS_CODE__426 = '426';
const STATUS_CODE__428 = '428';
const STATUS_CODE__429 = '429';
const STATUS_CODE__431 = '431';
const STATUS_CODE__451 = '451';
const STATUS_CODE__500 = '500';
const STATUS_CODE__501 = '501';
const STATUS_CODE__502 = '502';
const STATUS_CODE__503 = '503';
const STATUS_CODE__504 = '504';
const STATUS_CODE__505 = '505';
const STATUS_CODE__506 = '506';
const STATUS_CODE__507 = '507';
const STATUS_CODE__508 = '508';
const STATUS_CODE__509 = '509';
const STATUS_CODE__510 = '510';
const STATUS_CODE__511 = '511';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getStatusCodeAllowableValues()
    {
        return [
            self::STATUS_CODE__100,
self::STATUS_CODE__101,
self::STATUS_CODE__102,
self::STATUS_CODE__103,
self::STATUS_CODE__200,
self::STATUS_CODE__201,
self::STATUS_CODE__202,
self::STATUS_CODE__203,
self::STATUS_CODE__204,
self::STATUS_CODE__205,
self::STATUS_CODE__206,
self::STATUS_CODE__207,
self::STATUS_CODE__208,
self::STATUS_CODE__226,
self::STATUS_CODE__300,
self::STATUS_CODE__301,
self::STATUS_CODE__302,
self::STATUS_CODE__303,
self::STATUS_CODE__304,
self::STATUS_CODE__305,
self::STATUS_CODE__307,
self::STATUS_CODE__308,
self::STATUS_CODE__400,
self::STATUS_CODE__401,
self::STATUS_CODE__402,
self::STATUS_CODE__403,
self::STATUS_CODE__404,
self::STATUS_CODE__405,
self::STATUS_CODE__406,
self::STATUS_CODE__407,
self::STATUS_CODE__408,
self::STATUS_CODE__409,
self::STATUS_CODE__410,
self::STATUS_CODE__411,
self::STATUS_CODE__412,
self::STATUS_CODE__413,
self::STATUS_CODE__414,
self::STATUS_CODE__415,
self::STATUS_CODE__416,
self::STATUS_CODE__417,
self::STATUS_CODE__418,
self::STATUS_CODE__419,
self::STATUS_CODE__420,
self::STATUS_CODE__421,
self::STATUS_CODE__422,
self::STATUS_CODE__423,
self::STATUS_CODE__424,
self::STATUS_CODE__426,
self::STATUS_CODE__428,
self::STATUS_CODE__429,
self::STATUS_CODE__431,
self::STATUS_CODE__451,
self::STATUS_CODE__500,
self::STATUS_CODE__501,
self::STATUS_CODE__502,
self::STATUS_CODE__503,
self::STATUS_CODE__504,
self::STATUS_CODE__505,
self::STATUS_CODE__506,
self::STATUS_CODE__507,
self::STATUS_CODE__508,
self::STATUS_CODE__509,
self::STATUS_CODE__510,
self::STATUS_CODE__511,        ];
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
        $this->container['body'] = isset($data['body']) ? $data['body'] : null;
        $this->container['status_code'] = isset($data['status_code']) ? $data['status_code'] : null;
        $this->container['status_code_value'] = isset($data['status_code_value']) ? $data['status_code_value'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        $allowedValues = $this->getStatusCodeAllowableValues();
        if (!is_null($this->container['status_code']) && !in_array($this->container['status_code'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'status_code', must be one of '%s'",
                implode("', '", $allowedValues)
            );
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
     * Gets body
     *
     * @return object
     */
    public function getBody()
    {
        return $this->container['body'];
    }

    /**
     * Sets body
     *
     * @param object $body body
     *
     * @return $this
     */
    public function setBody($body)
    {
        $this->container['body'] = $body;

        return $this;
    }

    /**
     * Gets status_code
     *
     * @return string
     */
    public function getStatusCode()
    {
        return $this->container['status_code'];
    }

    /**
     * Sets status_code
     *
     * @param string $status_code status_code
     *
     * @return $this
     */
    public function setStatusCode($status_code)
    {
        $allowedValues = $this->getStatusCodeAllowableValues();
        if (!is_null($status_code) && !in_array($status_code, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'status_code', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['status_code'] = $status_code;

        return $this;
    }

    /**
     * Gets status_code_value
     *
     * @return int
     */
    public function getStatusCodeValue()
    {
        return $this->container['status_code_value'];
    }

    /**
     * Sets status_code_value
     *
     * @param int $status_code_value status_code_value
     *
     * @return $this
     */
    public function setStatusCodeValue($status_code_value)
    {
        $this->container['status_code_value'] = $status_code_value;

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
