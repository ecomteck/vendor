<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Controller\Onepage;

/**
 * One page checkout controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * After set vendor ID
     * 
     * @param int $vendorId
     * @return $this
     */
    public function afterSetVendorId($vendorId)
    {
        $this->vendorOnepageCheckout->setVendorId($vendorId);
        $this->vendorCheckoutSession->setVendorId($vendorId);
        return $this;
    }
    
}