<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorUser\Model\ResourceModel\User;

/**
 * User collection
 */
class Collection extends \Magento\User\Model\ResourceModel\User\Collection
{
    
    /**
     * Initialize select
     * 
     * @return $this
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addIsVendorField();
        return $this;
    }
    
}