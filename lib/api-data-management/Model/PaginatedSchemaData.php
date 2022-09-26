<?php
/**
 * PaginatedSchemaData
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
 * PaginatedSchemaData Class Doc Comment
 *
 * @category Class
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PaginatedSchemaData implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PaginatedSchema_data';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'business_profile_id' => 'int',
'primary_key' => 'OneOfPaginatedSchemaDataPrimaryKey',
'schema_name' => 'string',
'schema_id' => 'string',
'created_at' => 'string',
'created_by' => 'float',
'modified_at' => 'string',
'modified_by' => 'float',
'deleted_at' => 'string',
'deleted_by' => 'float',
'fields' => 'map[string,null]',
'layout' => '\Synerise\DataManagement\Model\OneOfPaginatedSchemaDataLayoutItems[]',
'relations' => 'map[string,null]',
'tags' => 'string[]',
'permission_status' => 'string'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'business_profile_id' => null,
'primary_key' => null,
'schema_name' => null,
'schema_id' => 'uuid',
'created_at' => null,
'created_by' => null,
'modified_at' => null,
'modified_by' => null,
'deleted_at' => null,
'deleted_by' => null,
'fields' => null,
'layout' => null,
'relations' => null,
'tags' => null,
'permission_status' => null    ];

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
        'business_profile_id' => 'businessProfileId',
'primary_key' => 'primaryKey',
'schema_name' => 'schemaName',
'schema_id' => 'schemaId',
'created_at' => 'createdAt',
'created_by' => 'createdBy',
'modified_at' => 'modifiedAt',
'modified_by' => 'modifiedBy',
'deleted_at' => 'deletedAt',
'deleted_by' => 'deletedBy',
'fields' => 'fields',
'layout' => 'layout',
'relations' => 'relations',
'tags' => 'tags',
'permission_status' => 'permissionStatus'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'business_profile_id' => 'setBusinessProfileId',
'primary_key' => 'setPrimaryKey',
'schema_name' => 'setSchemaName',
'schema_id' => 'setSchemaId',
'created_at' => 'setCreatedAt',
'created_by' => 'setCreatedBy',
'modified_at' => 'setModifiedAt',
'modified_by' => 'setModifiedBy',
'deleted_at' => 'setDeletedAt',
'deleted_by' => 'setDeletedBy',
'fields' => 'setFields',
'layout' => 'setLayout',
'relations' => 'setRelations',
'tags' => 'setTags',
'permission_status' => 'setPermissionStatus'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'business_profile_id' => 'getBusinessProfileId',
'primary_key' => 'getPrimaryKey',
'schema_name' => 'getSchemaName',
'schema_id' => 'getSchemaId',
'created_at' => 'getCreatedAt',
'created_by' => 'getCreatedBy',
'modified_at' => 'getModifiedAt',
'modified_by' => 'getModifiedBy',
'deleted_at' => 'getDeletedAt',
'deleted_by' => 'getDeletedBy',
'fields' => 'getFields',
'layout' => 'getLayout',
'relations' => 'getRelations',
'tags' => 'getTags',
'permission_status' => 'getPermissionStatus'    ];

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

    const PERMISSION_STATUS__PRIVATE = 'private';
const PERMISSION_STATUS_RESTRICTED = 'restricted';
const PERMISSION_STATUS__PRIVATE_2 = 'private';

    /**
     * Gets allowable values of the enum
     *
     * @return string[]
     */
    public function getPermissionStatusAllowableValues()
    {
        return [
            self::PERMISSION_STATUS__PRIVATE,
self::PERMISSION_STATUS_RESTRICTED,
self::PERMISSION_STATUS__PRIVATE_2,        ];
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
        $this->container['business_profile_id'] = isset($data['business_profile_id']) ? $data['business_profile_id'] : null;
        $this->container['primary_key'] = isset($data['primary_key']) ? $data['primary_key'] : null;
        $this->container['schema_name'] = isset($data['schema_name']) ? $data['schema_name'] : null;
        $this->container['schema_id'] = isset($data['schema_id']) ? $data['schema_id'] : null;
        $this->container['created_at'] = isset($data['created_at']) ? $data['created_at'] : null;
        $this->container['created_by'] = isset($data['created_by']) ? $data['created_by'] : null;
        $this->container['modified_at'] = isset($data['modified_at']) ? $data['modified_at'] : null;
        $this->container['modified_by'] = isset($data['modified_by']) ? $data['modified_by'] : null;
        $this->container['deleted_at'] = isset($data['deleted_at']) ? $data['deleted_at'] : null;
        $this->container['deleted_by'] = isset($data['deleted_by']) ? $data['deleted_by'] : null;
        $this->container['fields'] = isset($data['fields']) ? $data['fields'] : null;
        $this->container['layout'] = isset($data['layout']) ? $data['layout'] : null;
        $this->container['relations'] = isset($data['relations']) ? $data['relations'] : null;
        $this->container['tags'] = isset($data['tags']) ? $data['tags'] : null;
        $this->container['permission_status'] = isset($data['permission_status']) ? $data['permission_status'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

        if ($this->container['business_profile_id'] === null) {
            $invalidProperties[] = "'business_profile_id' can't be null";
        }
        if ($this->container['primary_key'] === null) {
            $invalidProperties[] = "'primary_key' can't be null";
        }
        if ($this->container['schema_name'] === null) {
            $invalidProperties[] = "'schema_name' can't be null";
        }
        if ($this->container['schema_id'] === null) {
            $invalidProperties[] = "'schema_id' can't be null";
        }
        if ($this->container['created_at'] === null) {
            $invalidProperties[] = "'created_at' can't be null";
        }
        if ($this->container['created_by'] === null) {
            $invalidProperties[] = "'created_by' can't be null";
        }
        if ($this->container['modified_at'] === null) {
            $invalidProperties[] = "'modified_at' can't be null";
        }
        if ($this->container['modified_by'] === null) {
            $invalidProperties[] = "'modified_by' can't be null";
        }
        if ($this->container['fields'] === null) {
            $invalidProperties[] = "'fields' can't be null";
        }
        if ($this->container['layout'] === null) {
            $invalidProperties[] = "'layout' can't be null";
        }
        if ($this->container['relations'] === null) {
            $invalidProperties[] = "'relations' can't be null";
        }
        if ($this->container['tags'] === null) {
            $invalidProperties[] = "'tags' can't be null";
        }
        if ($this->container['permission_status'] === null) {
            $invalidProperties[] = "'permission_status' can't be null";
        }
        $allowedValues = $this->getPermissionStatusAllowableValues();
        if (!is_null($this->container['permission_status']) && !in_array($this->container['permission_status'], $allowedValues, true)) {
            $invalidProperties[] = sprintf(
                "invalid value for 'permission_status', must be one of '%s'",
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
     * Gets business_profile_id
     *
     * @return int
     */
    public function getBusinessProfileId()
    {
        return $this->container['business_profile_id'];
    }

    /**
     * Sets business_profile_id
     *
     * @param int $business_profile_id Business profile ID
     *
     * @return $this
     */
    public function setBusinessProfileId($business_profile_id)
    {
        $this->container['business_profile_id'] = $business_profile_id;

        return $this;
    }

    /**
     * Gets primary_key
     *
     * @return OneOfPaginatedSchemaDataPrimaryKey
     */
    public function getPrimaryKey()
    {
        return $this->container['primary_key'];
    }

    /**
     * Sets primary_key
     *
     * @param OneOfPaginatedSchemaDataPrimaryKey $primary_key primary_key
     *
     * @return $this
     */
    public function setPrimaryKey($primary_key)
    {
        $this->container['primary_key'] = $primary_key;

        return $this;
    }

    /**
     * Gets schema_name
     *
     * @return string
     */
    public function getSchemaName()
    {
        return $this->container['schema_name'];
    }

    /**
     * Sets schema_name
     *
     * @param string $schema_name Name of the schema
     *
     * @return $this
     */
    public function setSchemaName($schema_name)
    {
        $this->container['schema_name'] = $schema_name;

        return $this;
    }

    /**
     * Gets schema_id
     *
     * @return string
     */
    public function getSchemaId()
    {
        return $this->container['schema_id'];
    }

    /**
     * Sets schema_id
     *
     * @param string $schema_id UUID of the schema
     *
     * @return $this
     */
    public function setSchemaId($schema_id)
    {
        $this->container['schema_id'] = $schema_id;

        return $this;
    }

    /**
     * Gets created_at
     *
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->container['created_at'];
    }

    /**
     * Sets created_at
     *
     * @param string $created_at Time of schema creation
     *
     * @return $this
     */
    public function setCreatedAt($created_at)
    {
        $this->container['created_at'] = $created_at;

        return $this;
    }

    /**
     * Gets created_by
     *
     * @return float
     */
    public function getCreatedBy()
    {
        return $this->container['created_by'];
    }

    /**
     * Sets created_by
     *
     * @param float $created_by ID of the user who created the schema
     *
     * @return $this
     */
    public function setCreatedBy($created_by)
    {
        $this->container['created_by'] = $created_by;

        return $this;
    }

    /**
     * Gets modified_at
     *
     * @return string
     */
    public function getModifiedAt()
    {
        return $this->container['modified_at'];
    }

    /**
     * Sets modified_at
     *
     * @param string $modified_at Time of last modification of the schema
     *
     * @return $this
     */
    public function setModifiedAt($modified_at)
    {
        $this->container['modified_at'] = $modified_at;

        return $this;
    }

    /**
     * Gets modified_by
     *
     * @return float
     */
    public function getModifiedBy()
    {
        return $this->container['modified_by'];
    }

    /**
     * Sets modified_by
     *
     * @param float $modified_by ID of the user who modified the schema
     *
     * @return $this
     */
    public function setModifiedBy($modified_by)
    {
        $this->container['modified_by'] = $modified_by;

        return $this;
    }

    /**
     * Gets deleted_at
     *
     * @return string
     */
    public function getDeletedAt()
    {
        return $this->container['deleted_at'];
    }

    /**
     * Sets deleted_at
     *
     * @param string $deleted_at Time of schema deletion
     *
     * @return $this
     */
    public function setDeletedAt($deleted_at)
    {
        $this->container['deleted_at'] = $deleted_at;

        return $this;
    }

    /**
     * Gets deleted_by
     *
     * @return float
     */
    public function getDeletedBy()
    {
        return $this->container['deleted_by'];
    }

    /**
     * Sets deleted_by
     *
     * @param float $deleted_by ID of the user who deleted the schema
     *
     * @return $this
     */
    public function setDeletedBy($deleted_by)
    {
        $this->container['deleted_by'] = $deleted_by;

        return $this;
    }

    /**
     * Gets fields
     *
     * @return map[string,null]
     */
    public function getFields()
    {
        return $this->container['fields'];
    }

    /**
     * Sets fields
     *
     * @param map[string,null] $fields The fields define the data that can be entered into a record.
     *
     * @return $this
     */
    public function setFields($fields)
    {
        $this->container['fields'] = $fields;

        return $this;
    }

    /**
     * Gets layout
     *
     * @return \Synerise\DataManagement\Model\OneOfPaginatedSchemaDataLayoutItems[]
     */
    public function getLayout()
    {
        return $this->container['layout'];
    }

    /**
     * Sets layout
     *
     * @param \Synerise\DataManagement\Model\OneOfPaginatedSchemaDataLayoutItems[] $layout The graphical layout of the schema. The layouts are displayed according to their order in the array.
     *
     * @return $this
     */
    public function setLayout($layout)
    {
        $this->container['layout'] = $layout;

        return $this;
    }

    /**
     * Gets relations
     *
     * @return map[string,null]
     */
    public function getRelations()
    {
        return $this->container['relations'];
    }

    /**
     * Sets relations
     *
     * @param map[string,null] $relations This object stores information (as objects) about relations to other schemas.
     *
     * @return $this
     */
    public function setRelations($relations)
    {
        $this->container['relations'] = $relations;

        return $this;
    }

    /**
     * Gets tags
     *
     * @return string[]
     */
    public function getTags()
    {
        return $this->container['tags'];
    }

    /**
     * Sets tags
     *
     * @param string[] $tags Tags assigned to the schema
     *
     * @return $this
     */
    public function setTags($tags)
    {
        $this->container['tags'] = $tags;

        return $this;
    }

    /**
     * Gets permission_status
     *
     * @return string
     */
    public function getPermissionStatus()
    {
        return $this->container['permission_status'];
    }

    /**
     * Sets permission_status
     *
     * @param string $permission_status Permission status of schema.
     *
     * @return $this
     */
    public function setPermissionStatus($permission_status)
    {
        $allowedValues = $this->getPermissionStatusAllowableValues();
        if (!in_array($permission_status, $allowedValues, true)) {
            throw new \InvalidArgumentException(
                sprintf(
                    "Invalid value for 'permission_status', must be one of '%s'",
                    implode("', '", $allowedValues)
                )
            );
        }
        $this->container['permission_status'] = $permission_status;

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
