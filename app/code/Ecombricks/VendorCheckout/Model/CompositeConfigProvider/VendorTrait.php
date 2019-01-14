<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Model\CompositeConfigProvider;

/**
 * Checkout composite config provider model vendor trait
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
        if (empty($this->vendorConfigProviders)) {
            return $this;
        }
        foreach ($this->vendorConfigProviders as $configProvider) {
            if ($this->canObjectAcceptVendorId($configProvider)) {
                $this->copyVendorId($configProvider, $vendorId);
            }
        }
        return $this;
    }
    
    /**
     * After get config
     * 
     * @param array $data
     * @return array
     */
    public function vendorAfterGetConfig($data)
    {
        $data['vendorId'] = $this->getVendorId();
        return $data;
    }
    
}