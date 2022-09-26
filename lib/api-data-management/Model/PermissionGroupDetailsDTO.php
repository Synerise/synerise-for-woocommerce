<?php
/**
 * PermissionGroupDetailsDTO
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
 * PermissionGroupDetailsDTO Class Doc Comment
 *
 * @category Class
 * @description This schema is **recursive**: the &#x60;children&#x60; array can include more groups, which include more groups, etc.
 * @package  Synerise\DataManagement
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */
class PermissionGroupDetailsDTO implements ModelInterface, ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      *
      * @var string
      */
    protected static $swaggerModelName = 'PermissionGroupDetailsDTO';

    /**
      * Array of property to type mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerTypes = [
        'id' => 'int',
'name' => 'string',
'slug' => 'string',
'path' => 'string',
'left' => 'int',
'right' => 'int',
'deep' => 'int',
'can_create' => 'bool',
'can_read' => 'bool',
'can_update' => 'bool',
'can_delete' => 'bool',
'can_execute' => 'bool',
'create' => 'bool',
'read' => 'bool',
'update' => 'bool',
'delete' => 'bool',
'execute' => 'bool',
'create_disabled' => 'bool',
'read_disabled' => 'bool',
'update_disabled' => 'bool',
'delete_disabled' => 'bool',
'execute_disabled' => 'bool',
'children' => '\Synerise\DataManagement\Model\PermissionGroupDetailsDTO[]'    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      *
      * @var string[]
      */
    protected static $swaggerFormats = [
        'id' => 'int64',
'name' => null,
'slug' => null,
'path' => null,
'left' => 'int32',
'right' => null,
'deep' => null,
'can_create' => null,
'can_read' => null,
'can_update' => null,
'can_delete' => null,
'can_execute' => null,
'create' => null,
'read' => null,
'update' => null,
'delete' => null,
'execute' => null,
'create_disabled' => null,
'read_disabled' => null,
'update_disabled' => null,
'delete_disabled' => null,
'execute_disabled' => null,
'children' => null    ];

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
        'id' => 'id',
'name' => 'name',
'slug' => 'slug',
'path' => 'path',
'left' => 'left',
'right' => 'right',
'deep' => 'deep',
'can_create' => 'canCreate',
'can_read' => 'canRead',
'can_update' => 'canUpdate',
'can_delete' => 'canDelete',
'can_execute' => 'canExecute',
'create' => 'create',
'read' => 'read',
'update' => 'update',
'delete' => 'delete',
'execute' => 'execute',
'create_disabled' => 'createDisabled',
'read_disabled' => 'readDisabled',
'update_disabled' => 'updateDisabled',
'delete_disabled' => 'deleteDisabled',
'execute_disabled' => 'executeDisabled',
'children' => 'children'    ];

    /**
     * Array of attributes to setter functions (for deserialization of responses)
     *
     * @var string[]
     */
    protected static $setters = [
        'id' => 'setId',
'name' => 'setName',
'slug' => 'setSlug',
'path' => 'setPath',
'left' => 'setLeft',
'right' => 'setRight',
'deep' => 'setDeep',
'can_create' => 'setCanCreate',
'can_read' => 'setCanRead',
'can_update' => 'setCanUpdate',
'can_delete' => 'setCanDelete',
'can_execute' => 'setCanExecute',
'create' => 'setCreate',
'read' => 'setRead',
'update' => 'setUpdate',
'delete' => 'setDelete',
'execute' => 'setExecute',
'create_disabled' => 'setCreateDisabled',
'read_disabled' => 'setReadDisabled',
'update_disabled' => 'setUpdateDisabled',
'delete_disabled' => 'setDeleteDisabled',
'execute_disabled' => 'setExecuteDisabled',
'children' => 'setChildren'    ];

    /**
     * Array of attributes to getter functions (for serialization of requests)
     *
     * @var string[]
     */
    protected static $getters = [
        'id' => 'getId',
'name' => 'getName',
'slug' => 'getSlug',
'path' => 'getPath',
'left' => 'getLeft',
'right' => 'getRight',
'deep' => 'getDeep',
'can_create' => 'getCanCreate',
'can_read' => 'getCanRead',
'can_update' => 'getCanUpdate',
'can_delete' => 'getCanDelete',
'can_execute' => 'getCanExecute',
'create' => 'getCreate',
'read' => 'getRead',
'update' => 'getUpdate',
'delete' => 'getDelete',
'execute' => 'getExecute',
'create_disabled' => 'getCreateDisabled',
'read_disabled' => 'getReadDisabled',
'update_disabled' => 'getUpdateDisabled',
'delete_disabled' => 'getDeleteDisabled',
'execute_disabled' => 'getExecuteDisabled',
'children' => 'getChildren'    ];

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
        $this->container['id'] = isset($data['id']) ? $data['id'] : null;
        $this->container['name'] = isset($data['name']) ? $data['name'] : null;
        $this->container['slug'] = isset($data['slug']) ? $data['slug'] : null;
        $this->container['path'] = isset($data['path']) ? $data['path'] : null;
        $this->container['left'] = isset($data['left']) ? $data['left'] : null;
        $this->container['right'] = isset($data['right']) ? $data['right'] : null;
        $this->container['deep'] = isset($data['deep']) ? $data['deep'] : null;
        $this->container['can_create'] = isset($data['can_create']) ? $data['can_create'] : null;
        $this->container['can_read'] = isset($data['can_read']) ? $data['can_read'] : null;
        $this->container['can_update'] = isset($data['can_update']) ? $data['can_update'] : null;
        $this->container['can_delete'] = isset($data['can_delete']) ? $data['can_delete'] : null;
        $this->container['can_execute'] = isset($data['can_execute']) ? $data['can_execute'] : null;
        $this->container['create'] = isset($data['create']) ? $data['create'] : null;
        $this->container['read'] = isset($data['read']) ? $data['read'] : null;
        $this->container['update'] = isset($data['update']) ? $data['update'] : null;
        $this->container['delete'] = isset($data['delete']) ? $data['delete'] : null;
        $this->container['execute'] = isset($data['execute']) ? $data['execute'] : null;
        $this->container['create_disabled'] = isset($data['create_disabled']) ? $data['create_disabled'] : null;
        $this->container['read_disabled'] = isset($data['read_disabled']) ? $data['read_disabled'] : null;
        $this->container['update_disabled'] = isset($data['update_disabled']) ? $data['update_disabled'] : null;
        $this->container['delete_disabled'] = isset($data['delete_disabled']) ? $data['delete_disabled'] : null;
        $this->container['execute_disabled'] = isset($data['execute_disabled']) ? $data['execute_disabled'] : null;
        $this->container['children'] = isset($data['children']) ? $data['children'] : null;
    }

    /**
     * Show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalidProperties = [];

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
     * Gets id
     *
     * @return int
     */
    public function getId()
    {
        return $this->container['id'];
    }

    /**
     * Sets id
     *
     * @param int $id ID of the group
     *
     * @return $this
     */
    public function setId($id)
    {
        $this->container['id'] = $id;

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
     * @param string $name Name of the permission group
     *
     * @return $this
     */
    public function setName($name)
    {
        $this->container['name'] = $name;

        return $this;
    }

    /**
     * Gets slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->container['slug'];
    }

    /**
     * Sets slug
     *
     * @param string $slug Slug of the permission group
     *
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->container['slug'] = $slug;

        return $this;
    }

    /**
     * Gets path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->container['path'];
    }

    /**
     * Sets path
     *
     * @param string $path Permission group path (uses names)
     *
     * @return $this
     */
    public function setPath($path)
    {
        $this->container['path'] = $path;

        return $this;
    }

    /**
     * Gets left
     *
     * @return int
     */
    public function getLeft()
    {
        return $this->container['left'];
    }

    /**
     * Sets left
     *
     * @param int $left Used by the frontend
     *
     * @return $this
     */
    public function setLeft($left)
    {
        $this->container['left'] = $left;

        return $this;
    }

    /**
     * Gets right
     *
     * @return int
     */
    public function getRight()
    {
        return $this->container['right'];
    }

    /**
     * Sets right
     *
     * @param int $right Used by the frontend
     *
     * @return $this
     */
    public function setRight($right)
    {
        $this->container['right'] = $right;

        return $this;
    }

    /**
     * Gets deep
     *
     * @return int
     */
    public function getDeep()
    {
        return $this->container['deep'];
    }

    /**
     * Sets deep
     *
     * @param int $deep Used by the frontend
     *
     * @return $this
     */
    public function setDeep($deep)
    {
        $this->container['deep'] = $deep;

        return $this;
    }

    /**
     * Gets can_create
     *
     * @return bool
     */
    public function getCanCreate()
    {
        return $this->container['can_create'];
    }

    /**
     * Sets can_create
     *
     * @param bool $can_create When TRUE, the `create` permission exists in this group.
     *
     * @return $this
     */
    public function setCanCreate($can_create)
    {
        $this->container['can_create'] = $can_create;

        return $this;
    }

    /**
     * Gets can_read
     *
     * @return bool
     */
    public function getCanRead()
    {
        return $this->container['can_read'];
    }

    /**
     * Sets can_read
     *
     * @param bool $can_read When TRUE, the `read` permission exists in this group.
     *
     * @return $this
     */
    public function setCanRead($can_read)
    {
        $this->container['can_read'] = $can_read;

        return $this;
    }

    /**
     * Gets can_update
     *
     * @return bool
     */
    public function getCanUpdate()
    {
        return $this->container['can_update'];
    }

    /**
     * Sets can_update
     *
     * @param bool $can_update When TRUE, the `update` permission exists in this group.
     *
     * @return $this
     */
    public function setCanUpdate($can_update)
    {
        $this->container['can_update'] = $can_update;

        return $this;
    }

    /**
     * Gets can_delete
     *
     * @return bool
     */
    public function getCanDelete()
    {
        return $this->container['can_delete'];
    }

    /**
     * Sets can_delete
     *
     * @param bool $can_delete When TRUE, the `delete` permission exists in this group.
     *
     * @return $this
     */
    public function setCanDelete($can_delete)
    {
        $this->container['can_delete'] = $can_delete;

        return $this;
    }

    /**
     * Gets can_execute
     *
     * @return bool
     */
    public function getCanExecute()
    {
        return $this->container['can_execute'];
    }

    /**
     * Sets can_execute
     *
     * @param bool $can_execute When TRUE, the `execute` permission exists in this group.
     *
     * @return $this
     */
    public function setCanExecute($can_execute)
    {
        $this->container['can_execute'] = $can_execute;

        return $this;
    }

    /**
     * Gets create
     *
     * @return bool
     */
    public function getCreate()
    {
        return $this->container['create'];
    }

    /**
     * Sets create
     *
     * @param bool $create When TRUE, the `create` permission is enabled.
     *
     * @return $this
     */
    public function setCreate($create)
    {
        $this->container['create'] = $create;

        return $this;
    }

    /**
     * Gets read
     *
     * @return bool
     */
    public function getRead()
    {
        return $this->container['read'];
    }

    /**
     * Sets read
     *
     * @param bool $read When TRUE, the `read` permission is enabled.
     *
     * @return $this
     */
    public function setRead($read)
    {
        $this->container['read'] = $read;

        return $this;
    }

    /**
     * Gets update
     *
     * @return bool
     */
    public function getUpdate()
    {
        return $this->container['update'];
    }

    /**
     * Sets update
     *
     * @param bool $update When TRUE, the `update` permission is enabled.
     *
     * @return $this
     */
    public function setUpdate($update)
    {
        $this->container['update'] = $update;

        return $this;
    }

    /**
     * Gets delete
     *
     * @return bool
     */
    public function getDelete()
    {
        return $this->container['delete'];
    }

    /**
     * Sets delete
     *
     * @param bool $delete When TRUE, the `delete` permission is enabled.
     *
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->container['delete'] = $delete;

        return $this;
    }

    /**
     * Gets execute
     *
     * @return bool
     */
    public function getExecute()
    {
        return $this->container['execute'];
    }

    /**
     * Sets execute
     *
     * @param bool $execute When TRUE, the `execute` permission is enabled.
     *
     * @return $this
     */
    public function setExecute($execute)
    {
        $this->container['execute'] = $execute;

        return $this;
    }

    /**
     * Gets create_disabled
     *
     * @return bool
     */
    public function getCreateDisabled()
    {
        return $this->container['create_disabled'];
    }

    /**
     * Sets create_disabled
     *
     * @param bool $create_disabled When TRUE, the `create` permission cannot be changed.
     *
     * @return $this
     */
    public function setCreateDisabled($create_disabled)
    {
        $this->container['create_disabled'] = $create_disabled;

        return $this;
    }

    /**
     * Gets read_disabled
     *
     * @return bool
     */
    public function getReadDisabled()
    {
        return $this->container['read_disabled'];
    }

    /**
     * Sets read_disabled
     *
     * @param bool $read_disabled When TRUE, the `read` permission cannot be changed.
     *
     * @return $this
     */
    public function setReadDisabled($read_disabled)
    {
        $this->container['read_disabled'] = $read_disabled;

        return $this;
    }

    /**
     * Gets update_disabled
     *
     * @return bool
     */
    public function getUpdateDisabled()
    {
        return $this->container['update_disabled'];
    }

    /**
     * Sets update_disabled
     *
     * @param bool $update_disabled When TRUE, the `update` permission cannot be changed.
     *
     * @return $this
     */
    public function setUpdateDisabled($update_disabled)
    {
        $this->container['update_disabled'] = $update_disabled;

        return $this;
    }

    /**
     * Gets delete_disabled
     *
     * @return bool
     */
    public function getDeleteDisabled()
    {
        return $this->container['delete_disabled'];
    }

    /**
     * Sets delete_disabled
     *
     * @param bool $delete_disabled When TRUE, the `delete` permission cannot be changed.
     *
     * @return $this
     */
    public function setDeleteDisabled($delete_disabled)
    {
        $this->container['delete_disabled'] = $delete_disabled;

        return $this;
    }

    /**
     * Gets execute_disabled
     *
     * @return bool
     */
    public function getExecuteDisabled()
    {
        return $this->container['execute_disabled'];
    }

    /**
     * Sets execute_disabled
     *
     * @param bool $execute_disabled When TRUE, the `execute` permission cannot be changed.
     *
     * @return $this
     */
    public function setExecuteDisabled($execute_disabled)
    {
        $this->container['execute_disabled'] = $execute_disabled;

        return $this;
    }

    /**
     * Gets children
     *
     * @return \Synerise\DataManagement\Model\PermissionGroupDetailsDTO[]
     */
    public function getChildren()
    {
        return $this->container['children'];
    }

    /**
     * Sets children
     *
     * @param \Synerise\DataManagement\Model\PermissionGroupDetailsDTO[] $children An array of rule groups in this group. This schema is **recursive**: the `children` array can include more groups, which include more groups, etc.
     *
     * @return $this
     */
    public function setChildren($children)
    {
        $this->container['children'] = $children;

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
