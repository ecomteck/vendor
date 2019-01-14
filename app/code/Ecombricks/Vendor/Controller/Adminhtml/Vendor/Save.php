<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Save vendor controller
 */
class Save extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Execute
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $request = $this->getRequest();
        $back = $request->getParam('back');
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        $vendorData = $request->getPostValue();
        if (empty($vendorData)) {
            return $resultRedirect->setPath('*/*/');
        }
        $vendor = $this->vendorFactory->create();
        $vendorId = $request->getParam('vendor_id');
        if ($vendorId) {
            $vendor->load($vendorId);
            if (!$vendor->getId()) {
                $this->messageManager->addError(__('The vendor no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
        }
        $vendor->fromArray($vendorData);
        $vendor->setLogo(
            (
                !empty($vendorData['logo_file']) && 
                !empty($vendorData['logo_file'][0]) && 
                !empty($vendorData['logo_file'][0]['name'])
            ) ? $vendorData['logo_file'][0]['name'] :null
        );
        try {
            $vendor->save();
            $this->messageManager->addSuccess(__('You saved the vendor.'));
            $this->_session->setVendorData(false);
            if ($back) {
                return $resultRedirect->setPath('*/*/edit', ['vendor_id' => $vendor->getId(), '_current' => true]);
            }
            return $resultRedirect->setPath('*/*/');
        } catch (\Magento\Framework\Exception\LocalizedException $exception) {
            $this->messageManager->addError($exception->getMessage());
        } catch (\RuntimeException $exception) {
            $this->messageManager->addError($exception->getMessage());
        } catch (\Exception $exception) {
            $this->messageManager->addException($exception, __('Something went wrong while saving the vendor.'));
        }
        $this->_session->setVendorData($vendor->toArray());
        return $resultRedirect->setPath('*/*/edit', ['vendor_id' => $vendorId]);
    }
    
}