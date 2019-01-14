<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Plugin\Model\ResourceModel\Role;

/**
 * Authorization role collection factory model plugin
 */
class CollectionFactory
{
    
    /**
     * Around create
     * 
     * @param \Magento\Authorization\Model\ResourceModel\Role\CollectionFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Authorization\Model\ResourceModel\Role\Collection
     */
    public function aroundCreate(
        \Magento\Authorization\Model\ResourceModel\Role\CollectionFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        $result = $proceed($data);
        $result->setIsVendor($subject->getIsVendor());
        return $result;
    }
    
}