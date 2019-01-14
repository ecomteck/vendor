<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\Model\Cart;

/**
 * Cart model vendor trait
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
        $this->unsetData('product_ids');
        $this->unsetData('quote');
        $this->_productIds = null;
        $this->_summaryQty = null;
        return $this;
    }
    
    /**
     * Set product vendor ID
     * 
     * @param \Magento\Catalog\Model\Product|int|string $productInfo
     * @return type
     */
    public function setProductVendorId($productInfo)
    {
        $product = $this->_getProduct($productInfo);
        $this->setVendorId($product->getVendorId());
        return $product;
    }
    
    /**
     * Add products by IDs
     *
     * @param int[] $productIds
     * @return $this
     */
    public function vendorAddProductsByIds($productIds)
    {
        $allAvailable = true;
        $allAdded = true;
        if (!empty($productIds)) {
            foreach ($productIds as $productId) {
                $productId = (int)$productId;
                if (!$productId) {
                    continue;
                }
                $product = $this->_getProduct($this->setProductVendorId($productId));
                if ($product->getId() && $product->isVisibleInCatalog()) {
                    try {
                        $this->getQuote()->addProduct($product);
                    } catch (\Exception $e) {
                        $allAdded = false;
                    }
                } else {
                    $allAvailable = false;
                }
            }
            if (!$allAvailable) {
                $this->messageManager->addError(__("We don't have some of the products you want."));
            }
            if (!$allAdded) {
                $this->messageManager->addError(__("We don't have as many of some products as you want."));
            }
        }
        return $this;
    }
    
}