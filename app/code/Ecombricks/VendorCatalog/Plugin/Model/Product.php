<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Model;

/**
 * Product model plugin
 */
class Product extends \Ecombricks\Vendor\Plugin\Framework\Model\AbstractModel
{
    
    /**
     * Around set data
     * 
     * @param \Magento\Catalog\Model\Product $subject
     * @param \Closure $proceed
     * @param string|array $key
     * @param mixed $value
     * @return \Magento\Catalog\Model\Product
     */
    public function aroundSetData(
        \Magento\Catalog\Model\Product $subject,
        \Closure $proceed,
        $key,
        $value = null
    )
    {
        return $this->setData($subject, $proceed, $key, $value);
    }
    
    /**
     * Around unset data
     * 
     * @param \Magento\Catalog\Model\Product $subject
     * @param \Closure $proceed
     * @param null|string|array $key
     * @return \Magento\Catalog\Model\Product
     */
    public function aroundUnsetData(
        \Magento\Catalog\Model\Product $subject,
        \Closure $proceed,
        $key = null
    )
    {
        return $this->unsetData($subject, $proceed, $key);
    }
    
}