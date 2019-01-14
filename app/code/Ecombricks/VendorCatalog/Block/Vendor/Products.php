<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Block\Vendor;

/**
 * Vendor products block
 */
class Products extends \Ecombricks\Vendor\Block\Vendor\AbstractVendor 
{
    
    /**
     * Get product list HTML
     * 
     * @return string
     */
    public function getProductListHtml()
    {
        return $this->getChildHtml('product_list');
    }
    
}