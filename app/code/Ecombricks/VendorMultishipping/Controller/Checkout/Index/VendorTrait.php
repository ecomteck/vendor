<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorMultishipping\Controller\Checkout\Index;

/**
 * Multishipping checkout index action vendor trait
 */
trait VendorTrait
{
    
    /**
     * After before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorAfterBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $this->vendorCheckoutSession->getQuote()->setIsMultiShipping(true);
        $this->vendorCheckoutSession->setCheckoutState(\Magento\Checkout\Model\Session::CHECKOUT_STATE_BEGIN);
        $this->vendorMultishippingCheckout->vendorInit();
        return $this;
    }
    
}