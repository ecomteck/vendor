<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button;

/**
 * Delete vendor button
 */
class Delete extends \Ecombricks\Vendor\Block\Adminhtml\Vendor\Edit\Button\Generic
{
    
    /**
     * Get delete URL
     * 
     * @return string
     */
    public function getDeleteUrl()
    {
        return $this->getUrl('*/*/delete', ['vendor_id' => $this->getVendorId()]);
    }
    
    /**
     * Get button data
     * 
     * @return array
     */
    public function getButtonData()
    {
        if (!$this->getVendorId()) {
            return [];
        }
        return [
            'label' => __('Delete Vendor'),
            'class' => 'delete',
            'on_click' => 'deleteConfirm(\''.__('Are you sure you want to do this?').'\', \''.$this->getDeleteUrl().'\')',
            'sort_order' => 20
        ];
    }
    
}