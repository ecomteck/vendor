<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model;

/**
 * Model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function setVendorId($vendorId)
    {
        if ($this->_getData('vendor_id') == $vendorId) {
            return $this;
        }
        $this->beforeSetVendorId($vendorId);
        $this->_data['vendor_id'] = $vendorId;
        foreach ($this->getVendorObjects() as $object) {
            $object->setVendorId($vendorId);
        }
        $this->afterSetVendorId($vendorId);
        return $this;
    }
    
    /**
     * Model before set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function modelBeforeSetVendorId($vendorId)
    {
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
        $this->modelBeforeSetVendorId($vendorId);
        return $this;
    }
    
    /**
     * Model after set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function modelAfterSetVendorId($vendorId)
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
        $this->_getResource()->vendorInitMainTable($this);
        $collection = $this->getCollection();
        if ($collection) {
            $collection->setVendorId($vendorId);
        }
        $this->modelAfterSetVendorId($vendorId);
        return $this;
    }
    
    /**
     * Get vendor ID
     * 
     * @return int
     */
    public function getVendorId()
    {
        return $this->_getData('vendor_id');
    }
    
    /**
     * Unset vendor ID
     * 
     * @return $this
     */
    public function unsVendorId()
    {
        if (isset($this->_data['vendor_id']) || array_key_exists('vendor_id', $this->_data)) {
            unset($this->_data['vendor_id']);
        }
        return $this;
    }
    
    /**
     * Get vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor|null
     */
    public function getVendor()
    {
        if ($this->hasData('vendor')) {
            return $this->getData('vendor');
        }
        $vendorId = $this->getVendorId();
        if ($vendorId) {
            $vendor = $this->vendorManagement->getVendor($vendorId);
        } else {
            $vendor = null;
        }
        $this->setData('vendor', $vendor);
        return $vendor;
    }
    
    /**
     * Get vendor name
     * 
     * @return string
     */
    public function getVendorName()
    {
        $vendor = $this->getVendor();
        return ($vendor) ? $vendor->getName() : null;
    }
    
    /**
     * Check if vendor table is defined
     * 
     * @return boolean
     */
    protected function hasVendorTableDefined()
    {
        return $this->_getResource()->hasVendorTableDefined();
    }
    
    /**
     * Check if vendor ID exists
     * 
     * @return bool
     */
    public function isVendorIdExists()
    {
        return $this->hasVendorTableDefined() || $this->getVendorId();
    }
    
    /**
     * Validate vendor ID
     * 
     * @return bool
     */
    public function validateVendorId($vendorId)
    {
        return $this->vendorManagement->validateVendorId($vendorId);
    }
    
    /**
     * Update stored data
     * 
     * @return $this
     */
    protected function vendorUpdateStoredData()
    {
        if (isset($this->_data)) {
            $this->storedData = $this->_data;
        } else {
            $this->storedData = [];
        }
        return $this;
    }
    
    /**
     * Reset data
     * 
     * @return $this
     */
    public function vendorResetData()
    {
        $this->setData([]);
        $this->isObjectNew(true);
        $this->setOrigData();
        $this->setHasDataChanges(false);
        $this->vendorUpdateStoredData();
        return $this;
    }
    
    /**
     * Model after load
     * 
     * @return $this
     */
    public function vendorModelAfterLoad()
    {
        return $this;
    }
    
    /**
     * After load
     * 
     * @return $this
     */
    public function vendorAfterLoad()
    {
        $this->_getResource()->loadVendorId($this);
        if ($this->getId() && $this->isVendorIdExists() && !$this->validateVendorId($this->getVendorId())) {
            $this->vendorResetData();
        }
        if ($this->getId() && $this->hasVendorTableDefined() && !$this->getVendorId()) {
            $this->setVendorId($this->vendorManagement->getDefaultVendorId());
        }
        $this->vendorModelAfterLoad();
        return $this;
    }
    
    /**
     * Model before save
     * 
     * @return $this
     */
    public function vendorModelBeforeSave()
    {
        return $this;
    }
    
    /**
     * Validate vendor ID before save
     * 
     * @return $this
     * @throws \Magento\Framework\Exception\ValidatorException
     */
    public function validateVendorIdBeforeSave()
    {
        if (!$this->isVendorIdExists()) {
            return $this;
        }
        if (!$this->validateVendorId($this->getVendorId())) {
            throw new \Magento\Framework\Exception\ValidatorException(__('Invalid vendor ID.'));
        }
        if ($this->getId()) {
            $oldVendorId = $this->_getResource()->getVendorId($this);
            if (!$this->validateVendorId($oldVendorId)) {
                throw new \Magento\Framework\Exception\ValidatorException(__('Invalid ID.'));
            }
        }
        return $this;
    }
    
    /**
     * Before save
     * 
     * @return $this
     */
    public function vendorBeforeSave()
    {
        $this->vendorModelBeforeSave();
        $this->validateVendorIdBeforeSave();
        return $this;
    }
    
    /**
     * Model after save
     * 
     * @return $this
     */
    public function vendorModelAfterSave()
    {
        return $this;
    }
    
    /**
     * After save
     * 
     * @return $this
     */
    public function vendorAfterSave()
    {
        $this->_getResource()->saveVendorId($this);
        $this->vendorModelAfterSave();
        return $this;
    }
    
    /**
     * Model before delete
     * 
     * @return $this
     */
    public function vendorModelBeforeDelete()
    {
        return $this;
    }
    
    /**
     * Before delete
     * 
     * @return $this
     */
    public function vendorBeforeDelete()
    {
        $this->vendorModelBeforeDelete();
        if (!$this->isVendorIdExists()) {
            return $this;
        }
        $resource = $this->_getResource();
        if ($this->getId()) {
            $vendorId = $resource->getVendorId($this);
            if ($vendorId) {
                if (!$this->validateVendorId($vendorId)) {
                    throw new \Magento\Framework\Exception\ValidatorException(__('Invalid ID.'));
                }
            }
        }
        return $this;
    }
    
}