<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Model\ResourceModel\Order\Payment\Transaction\Grid;

/**
 * Payment transaction grid collection
 */
class Collection extends \Magento\Sales\Model\ResourceModel\Transaction\Grid\Collection
{
    
    /**
     * Initialize select
     * 
     * @return $this
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->addVendorField();
        return $this;
    }
    
}