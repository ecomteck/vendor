<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework;

/**
 * Vendor trait
 */
trait VendorTrait
{
    
    /**
     * Vendor ID
     * 
     * @var int
     */
    protected $vendorId;
    
    /**
     * Vendor object keys
     * 
     * @var array
     */
    protected $vendorObjectKeys;
    
    /**
     * Vendor objects
     * 
     * @var array
     */
    protected $vendorObjects;
    
    /**
     * Check if object can accept vendor ID
     * 
     * @param object $object
     * @return bool
     */
    public function canObjectAcceptVendorId($object)
    {
        return $object && is_object($object) && method_exists($object, 'setVendorId');
    }
    
    /**
     * Copy vendor ID
     * 
     * @param object $object
     * @param int $vendorId
     * @return $this
     */
    public function copyVendorId($object, $vendorId)
    {
        if ($this->canObjectAcceptVendorId($object)) {
            $object->setVendorId($vendorId);
        }
        return $this;
    }
    
    /**
     * Set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId($vendorId)
    {
        if ($this->vendorId == $vendorId) {
            return $this;
        }
        $this->beforeSetVendorId($vendorId);
        $this->vendorId = $vendorId;
        foreach ($this->getVendorObjects() as $object) {
            $this->copyVendorId($object, $vendorId);
        }
        $this->afterSetVendorId($vendorId);
        return $this;
    }
    
    /**
     * Before set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function beforeSetVendorId($vendorId)
    {
        return $this;
    }
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return $this->vendorId;
    }
    
    /**
     * Unset vendor ID
     * 
     * @return $this
     */
    public function unsVendorId()
    {
        $this->vendorId = null;
        return $this;
    }
    
    /**
     * Get vendor object keys
     * 
     * @return array
     */
    public function getVendorObjectKeys()
    {
        if ($this->vendorObjectKeys !== null) {
            return $this->vendorObjectKeys;
        }
        return array_keys(get_object_vars($this));
    }
    
    /**
     * Get vendor objects
     * 
     * @return array
     */
    public function getVendorObjects()
    {
        if ($this->vendorObjects !== null) {
            return $this->vendorObjects;
        }
        $objects = [];
        $objectKeys = $this->getVendorObjectKeys();
        if (empty($objectKeys)) {
            $this->vendorObjects = [];
            return $this->vendorObjects;
        }
        foreach ($objectKeys as $objectKey) {
            if (empty($this->$objectKey)) {
                continue;
            }
            $object = $this->$objectKey;
            if (!$this->canObjectAcceptVendorId($object)) {
                continue;
            }
            $objects[$objectKey] = $object;
        }
        $this->vendorObjects = $objects;
        return $this->vendorObjects;
    }
    
}