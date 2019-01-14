<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorReports\Plugin\Model\ResourceModel\Customer;

/**
 * Reports customer collection model plugin
 */
class Collection
{
    
    /**
     * Around add cart info
     * 
     * @param \Magento\Reports\Model\ResourceModel\Customer\Collection $subject
     * @param \Closure $proceed
     * @return $this
     */
    public function aroundAddCartInfo(
        \Magento\Reports\Model\ResourceModel\Customer\Collection $subject,
        \Closure $proceed
    )
    {
        return $subject->vendorAddCartInfo();
    }
    
}