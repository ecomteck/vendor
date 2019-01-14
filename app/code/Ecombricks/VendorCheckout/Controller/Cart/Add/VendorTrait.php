<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Controller\Cart\Add;

/**
 * Cart add controller vendor trait
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
            $productId = (int) $request->getParam('product');
            $storeId = $this->vendorStoreManager->getStore()->getId();
            if ($productId) {
                $product = $this->vendorProductRepository->getById($productId, false, $storeId);
                if ($product->getId()) {
                    $vendorId = $product->getVendorId();
                }
            }
        }
        if ($vendorId && $this->vendorManagement->validateVendorId($vendorId)) {
            $this->setVendorId($vendorId);
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}