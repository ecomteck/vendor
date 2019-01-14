<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Controller\Cart\Index;

/**
 * Cart index controller vendor trait
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
        if (!$vendorId) {
            $vendorId = $this->vendorManagement->getFirstVendorId();
        }
        if ($vendorId && $this->vendorManagement->validateVendorId($vendorId)) {
            $this->setVendorId($vendorId);
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
    /**
     * After execute
     * 
     * @param \Magento\Framework\View\Result\Page $resultPage
     * @return $this
     */
    public function vendorAfterExecute(\Magento\Framework\View\Result\Page $resultPage)
    {
        $resultPage
            ->getConfig()
            ->getTitle()
            ->set(__('%1 Shopping Cart', $this->vendorManagement->getVendorName($this->getVendorId())));
        return $this;
    }
    
}