<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Edit vendor controller
 */
class Edit extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Execute
     * 
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $vendorId = $this->getRequest()->getParam('vendor_id');
        $vendor = $this->vendorFactory->create();
        if ($vendorId) {
            $vendor->load($vendorId);
            if (!$vendor->getId()) {
                $this->messageManager->addError(__('The vendor no longer exists.'));
                $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
                return $resultRedirect->setPath('*/*/');
            }
        }
        $vendorData = $this->_session->getVendorData(true);
        if (!empty($vendorData)) {
            $vendor->fromArray($vendorData);
        }
        $this->registry->register('vendor', $vendor);
        $resultPage = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_PAGE);
        $title = $vendorId ? __('Edit Vendor') : __('New Vendor');
        $this->initResultPage($resultPage)->addBreadcrumb($title, $title);
        $resultPageTitle = $resultPage->getConfig()->getTitle();
        $resultPageTitle->prepend(__('Vendors'));
        $resultPageTitle->prepend($vendor->getId() ? $vendor->getName() : __('New Vendor'));
        return $resultPage;
    }
    
}