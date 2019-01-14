<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button;

/**
 * Save and continue vendor button
 */
class SaveAndContinue extends \Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button\Generic
{
    
    /**
     * Get button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Save and Continue Edit'),
            'class' => 'save',
            'data_attribute' => [
                'mage-init' => [
                    'button' => ['event' => 'saveAndContinueEdit'],
                ],
            ],
            'sort_order' => 80
        ];
    }
    
}