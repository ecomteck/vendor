<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorBackend\Block\Widget\Grid\Column;

/**
 * Is vendor grid column
 */
class IsVendor extends \Magento\Backend\Block\Widget\Grid\Column
{
    
    /**
     * Construct
     * 
     * @return void
     */
    public function _construct()
    {
        parent::_construct();
        $this->setData('header', __('Is Vendor'));
        $this->setData('index', 'is_vendor');
        $this->setData('renderer', $this->_rendererTypes['options']);
        $this->setData('filter', $this->_filterTypes['options']);
        $this->setData('options', [
            ['label' => 'Yes', 'value' => 1],
            ['label' => 'No', 'value' => 0]
        ]);
    }
    
}