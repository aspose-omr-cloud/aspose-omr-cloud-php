<?php
/*
Copyright (c) 2018 Aspose Pty Ltd. All Rights Reserved.

Licensed under the MIT (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

      https://github.com/aspose-omr-cloud/aspose-omr-cloud-php/blob/master/LICENSE

Unless required by applicable law or agreed to in writing, software
distributed under the License is distributed on an "AS IS" BASIS,
WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
See the License for the specific language governing permissions and
limitations under the License.



    Aspose.OMR for Cloud API Reference

    Aspose.OMR for Cloud helps performing optical mark recognition in the cloud

    OpenAPI spec version: 1.1
    
    Generated by: https://github.com/swagger-api/swagger-codegen.git
*/

/**
 * OMRResponse
 *
 * PHP version 5
 *
 * @category Class
 * @package  Aspose\Omr
 * @author   Swagger Codegen team
 * @link     https://github.com/swagger-api/swagger-codegen
 */

/**
 * NOTE: This class is auto generated by the swagger code generator program.
 * https://github.com/swagger-api/swagger-codegen
 * Do not edit the class manually.
 */

namespace Aspose\Omr\Model;

use \ArrayAccess;

/**
 * OMRResponse Class Doc Comment
 *
 * @category    Class
 * @description Represents information about response after OMR.
 * @package     Aspose\Omr
 * @author      Swagger Codegen team
 * @link        https://github.com/swagger-api/swagger-codegen
 */
class OMRResponse implements ArrayAccess
{
    const DISCRIMINATOR = null;

    /**
      * The original name of the model.
      * @var string
      */
    protected static $swaggerModelName = 'OMRResponse';

    /**
      * Array of property to type mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerTypes = [
        'status' => 'string',
        'errorCode' => 'int',
        'errorText' => 'string',
        'payload' => '\Aspose\Omr\Model\Payload',
        'serverStat' => '\Aspose\Omr\Model\ServerStat'
    ];

    /**
      * Array of property to format mappings. Used for (de)serialization
      * @var string[]
      */
    protected static $swaggerFormats = [
        'status' => null,
        'errorCode' => 'int32',
        'errorText' => null,
        'payload' => null,
        'serverStat' => null
    ];

    public static function swaggerTypes()
    {
        return self::$swaggerTypes;
    }

    public static function swaggerFormats()
    {
        return self::$swaggerFormats;
    }

    /**
     * Array of attributes where the key is the local name, and the value is the original name
     * @var string[]
     */
    protected static $attributeMap = [
        'status' => 'Status',
        'errorCode' => 'ErrorCode',
        'errorText' => 'ErrorText',
        'payload' => 'Payload',
        'serverStat' => 'ServerStat'
    ];


    /**
     * Array of attributes to setter functions (for deserialization of responses)
     * @var string[]
     */
    protected static $setters = [
        'status' => 'setStatus',
        'errorCode' => 'setErrorCode',
        'errorText' => 'setErrorText',
        'payload' => 'setPayload',
        'serverStat' => 'setServerStat'
    ];


    /**
     * Array of attributes to getter functions (for serialization of requests)
     * @var string[]
     */
    protected static $getters = [
        'status' => 'getStatus',
        'errorCode' => 'getErrorCode',
        'errorText' => 'getErrorText',
        'payload' => 'getPayload',
        'serverStat' => 'getServerStat'
    ];

    public static function attributeMap()
    {
        return self::$attributeMap;
    }

    public static function setters()
    {
        return self::$setters;
    }

    public static function getters()
    {
        return self::$getters;
    }

    

    

    /**
     * Associative array for storing property values
     * @var mixed[]
     */
    protected $container = [];

    /**
     * Constructor
     * @param mixed[] $data Associated array of property values initializing the model
     */
    public function __construct(array $data = null)
    {
        $this->container['status'] = isset($data['status']) ? $data['status'] : null;
        $this->container['errorCode'] = isset($data['errorCode']) ? $data['errorCode'] : null;
        $this->container['errorText'] = isset($data['errorText']) ? $data['errorText'] : null;
        $this->container['payload'] = isset($data['payload']) ? $data['payload'] : null;
        $this->container['serverStat'] = isset($data['serverStat']) ? $data['serverStat'] : null;
    }

    /**
     * show all the invalid properties with reasons.
     *
     * @return array invalid properties with reasons
     */
    public function listInvalidProperties()
    {
        $invalid_properties = [];

        return $invalid_properties;
    }

    /**
     * validate all the properties in the model
     * return true if all passed
     *
     * @return bool True if all properties are valid
     */
    public function valid()
    {

        return true;
    }


    /**
     * Gets status
     * @return string
     */
    public function getStatus()
    {
        return $this->container['status'];
    }

    /**
     * Sets status
     * @param string $status Indicates operation's status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->container['status'] = $status;

        return $this;
    }

    /**
     * Gets errorCode
     * @return int
     */
    public function getErrorCode()
    {
        return $this->container['errorCode'];
    }

    /**
     * Sets errorCode
     * @param int $errorCode Integer field that indicates whether any critical errors occured during task execution
     * @return $this
     */
    public function setErrorCode($errorCode)
    {
        $this->container['errorCode'] = $errorCode;

        return $this;
    }

    /**
     * Gets errorText
     * @return string
     */
    public function getErrorText()
    {
        return $this->container['errorText'];
    }

    /**
     * Sets errorText
     * @param string $errorText String description of occured critical error. Empty if no critical errors occured
     * @return $this
     */
    public function setErrorText($errorText)
    {
        $this->container['errorText'] = $errorText;

        return $this;
    }

    /**
     * Gets payload
     * @return \Aspose\Omr\Model\Payload
     */
    public function getPayload()
    {
        return $this->container['payload'];
    }

    /**
     * Sets payload
     * @param \Aspose\Omr\Model\Payload $payload Payload
     * @return $this
     */
    public function setPayload($payload)
    {
        $this->container['payload'] = $payload;

        return $this;
    }

    /**
     * Gets serverStat
     * @return \Aspose\Omr\Model\ServerStat
     */
    public function getServerStat()
    {
        return $this->container['serverStat'];
    }

    /**
     * Sets serverStat
     * @param \Aspose\Omr\Model\ServerStat $serverStat Server statistics
     * @return $this
     */
    public function setServerStat($serverStat)
    {
        $this->container['serverStat'] = $serverStat;

        return $this;
    }
    /**
     * Returns true if offset exists. False otherwise.
     * @param  integer $offset Offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    /**
     * Gets offset.
     * @param  integer $offset Offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }

    /**
     * Sets value based on offset.
     * @param  integer $offset Offset
     * @param  mixed   $value  Value to be set
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
     * @param  integer $offset Offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    /**
     * Gets the string presentation of the object
     * @return string
     */
    public function __toString()
    {
        if (defined('JSON_PRETTY_PRINT')) { // use JSON pretty print
            return json_encode(\Aspose\Omr\ObjectSerializer::sanitizeForSerialization($this), JSON_PRETTY_PRINT);
        }

        return json_encode(\Aspose\Omr\ObjectSerializer::sanitizeForSerialization($this));
    }
}


