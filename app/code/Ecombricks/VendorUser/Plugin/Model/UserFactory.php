<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUser\Plugin\Model;

/**
 * User factory model plugin
 */
class UserFactory
{
    
    /**
     * Around create
     * 
     * @param \Magento\User\Model\UserFactory $subject
     * @param \Closure $proceed
     * @param array $data
     * @return \Magento\User\Model\User
     */
    public function aroundCreate(
        \Magento\User\Model\UserFactory $subject,
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