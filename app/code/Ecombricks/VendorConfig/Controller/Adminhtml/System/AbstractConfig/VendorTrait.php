<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorConfig\Controller\Adminhtml\System\AbstractConfig;

/**
 * Abstract config action vendor trait
 */
trait VendorTrait
{
    
    /**
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $vendorId = (int) $request->getParam('vendor');
        if (!$vendorId || !$this->vendorManagement->validateVendorId($vendorId)) {
            if ($this->vendorManagement->isCurrentUserVendor()) {
                $vendorId = $this->vendorManagement->getFirstVendorId();
            }
        }
        if ($vendorId && $this->vendorManagement->validateVendorId($vendorId)) {
            $this->setVendorId($vendorId);
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}