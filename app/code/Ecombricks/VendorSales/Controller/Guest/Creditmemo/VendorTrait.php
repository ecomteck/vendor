<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Guest\Creditmemo;

/**
 * Guest creditmemo controller vendor trait
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
        $creditmemo = $this->vendorGetCreditmemo($request->getParam('creditmemo_id'));
        if (!empty($creditmemo)) {
            $order = $creditmemo->getOrder();
        }
        if (empty($order)) {
            $order = $this->vendorGetOrder($this->vendorGetOrderIncrementId($request));
        }
        if (!empty($order)) {
            $this->setVendorId($order->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}