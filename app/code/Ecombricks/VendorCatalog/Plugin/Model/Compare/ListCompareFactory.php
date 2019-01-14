<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Model\Compare;

/**
 * Compare list model factory plugin
 */
class ListCompareFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Catalog\Model\Product\Compare\ListCompareFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Catalog\Model\Product\Compare\ListCompare
     */
    public function aroundCreate(
        \Magento\Catalog\Model\Product\Compare\ListCompareFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        $result = $proceed($data);
        $this
            ->setSubject($subject)
            ->setVendorId($result);
        return $result;
    }
    
}