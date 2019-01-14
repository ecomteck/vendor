<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Model\ResourceModel\Fulltext\Collection;

/**
 * Catalog search full text collection model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Before add vendor filter
     * 
     * @param int $vendorId
     * @return $this
     */
    public function beforeAddVendorFilter($vendorId)
    {
        $this->addFieldToFilter('vendor_id', $vendorId);
        return $this;
    }
    
}