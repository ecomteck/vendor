<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Plugin\Model;

/**
 * Authorization role factory model plugin
 */
class RoleFactory
{
    
    /**
     * Around create
     * 
     * @param \Magento\Authorization\Model\RoleFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\Authorization\Model\Role
     */
    public function aroundCreate(
        \Magento\Authorization\Model\RoleFactory $subject,
        \Closure $proceed,
        array $data = []
    )
    {
        $object = $proceed($data);
        $isVendor = $subject->getIsVendor();
        if ($isVendor !== null) {
            $object->setAfterLoadIsVendor($subject->getIsVendor());
        }
        return $object;
    }
    
}