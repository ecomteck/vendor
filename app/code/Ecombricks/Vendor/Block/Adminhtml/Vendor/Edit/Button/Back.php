<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button;

/**
 * Back vendor button
 */
class Back extends \Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button\Generic
{
    
    /**
     * Get back URL
     *
     * @return string
     */
    public function getBackUrl()
    {
        return $this->getUrl('*/*/');
    }
    
    /**
     * Get button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getBackUrl()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }
    
}