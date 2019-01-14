<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Model\ResourceModel\Role\Grid;

/**
 * Authorization role grid collection
 */
class Collection extends \Magento\Authorization\Model\ResourceModel\Role\Grid\Collection
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