<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Framework\App\Action\Action;

/**
 * Action vendor trait
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
        if ($vendorId && $this->vendorManagement->validateVendorId($vendorId)) {
            $this->setVendorId($vendorId);
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
    /**
     * After before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorAfterBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        return $this;
    }
    
    /**
     * Before execute
     * 
     * @return $this
     */
    public function vendorBeforeExecute()
    {
        $vendorId = $this->getVendorId();
        if (!$vendorId) {
            return $this;
        }
        $layout = $this->_view->getLayout();
        $layout->setVendorId($vendorId);
        return $this;
    }
    
}