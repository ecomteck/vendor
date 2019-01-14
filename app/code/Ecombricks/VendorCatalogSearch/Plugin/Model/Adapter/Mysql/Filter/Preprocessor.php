<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalogSearch\Plugin\Model\Adapter\Mysql\Filter;

/**
 * Catalog search filter preprocessor model plugin
 */
class Preprocessor
{
    
    /**
     * Around process
     * 
     * @param \Magento\CatalogSearch\Model\Adapter\Mysql\Filter\Preprocessor $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Search\Request\FilterInterface $filter
     * @param bool $isNegation
     * @param string $query
     * @return string
     */
    public function aroundProcess(
        \Magento\CatalogSearch\Model\Adapter\Mysql\Filter\Preprocessor $subject,
        \Closure $proceed,
        \Magento\Framework\Search\Request\FilterInterface $filter,
        $isNegation,
        $query
    )
    {
        if ($filter->getField() == 'vendor_id') {
            $vendorId = (int) $filter->getValue();
            return 'vendor_id_index.vendor_id = '.$vendorId;
        }
        return $proceed($filter, $isNegation, $query);
    }
    
}