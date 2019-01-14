<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button;

/**
 * Save vendor button
 */
class Save extends \Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button\Generic
{
    
    /**
     * Get button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save Vendor'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => ['button' => ['event' => 'save']],
                'form-role' => 'save'
            ],
            'sort_order' => 90
        ];
    }
    
}