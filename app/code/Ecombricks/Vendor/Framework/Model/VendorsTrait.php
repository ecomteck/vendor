<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\Model;

/**
 * Model vendors trait
 */
trait VendorsTrait
{
    
    /**
     * Get vendor IDs
     * 
     * @return int[]
     */
    public function getVendorIds()
    {
        $vendorIds = $this->_getData('vendor_ids');
        if ($vendorIds === null) {
            $this->vendorsAfterLoad();
            $vendorIds = $this->_getData('vendor_ids');
        }
        return $vendorIds;
    }
    
    /**
     * After load
     * 
     * @param \Magento\Framework\Model\AbstractModel $object
     * @return $this
     */
    public function vendorsAfterLoad()
    {
        $this->_getResource()->loadVendorIds($this);
        return $this;
    }
    
    /**
     * After save
     * 
     * @return $this
     */
    public function vendorsAfterSave()
    {
        $this->_getResource()->saveVendorIds($this);
        return $this;
    }
    
    /**
     * Before delete
     * 
     * @return $this
     */
    public function vendorsBeforeDelete()
    {
        $this->_getResource()->deleteVendorIds($this);
        return $this;
    }
    
}