<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Delete vendor controller
 */
class Delete extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Execute
     * 
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $vendorId = $this->getRequest()->getParam('vendor_id');
        if ($vendorId) {
            try {
                $vendor = $this->vendorFactory->create();
                $vendor->load($vendorId);
                $vendor->delete();
                $this->messageManager->addSuccess(__('The vendor has been deleted.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $exception) {
                $this->messageManager->addError($exception->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['vendor_id' => $vendorId]);
            }
        }
        $this->messageManager->addError(__('We can\'t find a vendor to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
    
}