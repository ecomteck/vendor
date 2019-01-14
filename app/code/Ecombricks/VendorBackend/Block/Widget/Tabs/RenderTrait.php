<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorBackend\Block\Widget\Tabs;

/**
 * Tabs block render trait
 */
trait RenderTrait
{
    
    /**
     * Assign tabs
     *
     * @return array
     */
    public function vendorAssignTabs()
    {
        $activeTab = $this->getRequest()->getParam('active_tab');
        if ($activeTab) {
            $this->setActiveTab($activeTab);
        } else {
            $activeTabId = $this->_authSession->getActiveTabId();
            if ($activeTabId) {
                $this->_setActiveTab($activeTabId);
            }
        }
        $_new = [];
        $tabIds = array_keys($this->_tabs);
        if (count($tabIds)) {
            if (!in_array($this->_activeTab, $tabIds)) {
                $this->setActiveTab(current($tabIds));
            }
        } else {
            $this->_activeTab = null;
        }
        foreach ($this->_tabs as $key => $tab) {
            foreach ($this->_tabs as $key2 => $tab2) {
                if ($tab2->getAfter() == $key) {
                    $_new[$key] = $tab;
                    $_new[$key2] = $tab2;
                } else if (!$tab->getAfter() || !in_array($tab->getAfter(), $tabIds)) {
                    $_new[$key] = $tab;
                }
            }
        }
        $this->_tabs = $_new;
        unset($_new);
        $this->assign('tabs', $this->_tabs);
        return $this;
    }
    
}