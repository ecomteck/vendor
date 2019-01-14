<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\ResourceModel\Vendor;

/**
 * Vendor collection
 */
class Collection extends \Ecombricks\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    
    /**
     * ID field name
     * 
     * @var string
     */
    protected $_idFieldName = 'vendor_id';
    
    /**
     * Constructor
     * 
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Ecombricks\Vendor\Model\Vendor::class, \Ecombricks\Vendor\Model\ResourceModel\Vendor::class);
        $this->_map['fields']['vendor_id'] = 'main_table.vendor_id';
    }
    
    /**
     * Set default order
     * 
     * @return $this
     */
    public function setDefaultOrder()
    {
        $this->setOrder('name', \Magento\Framework\Data\Collection::SORT_ORDER_ASC);
        return $this;
    }
    
    /**
     * Before load action
     * 
     * @return $this
     */
    protected function _beforeLoad()
    {
        parent::_beforeLoad();
        return $this;
    }
    
}