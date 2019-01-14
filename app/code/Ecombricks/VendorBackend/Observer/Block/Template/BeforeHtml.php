<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorBackend\Observer\Block\Template;

/**
 * Backend template before html block observer
 */
class BeforeHtml implements \Magento\Framework\Event\ObserverInterface
{
    
    /**
     * Modify dashboard block
     * 
     * @param \Magento\Backend\Block\Dashboard\Grids $block
     * @return $this
     */
    protected function modifyDashboardGridsBlock($block)
    {
        if ($block->getVendorId()) {
            $block->removeTab('ordered_products');
            $block->vendorAssignTabs();
        }
        return $this;
    }
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $block = $observer->getEvent()->getBlock();
        if (!$block) {
            return $this;
        }
        if ($block instanceof \Magento\Backend\Block\Dashboard\Grids) {
            $this->modifyDashboardGridsBlock($block);
        }
        return $this;
    }

}