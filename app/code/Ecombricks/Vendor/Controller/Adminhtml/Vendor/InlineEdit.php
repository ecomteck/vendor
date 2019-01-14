<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Inline edit vendor controller
 */
class InlineEdit extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Execute
     * 
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultJson = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_JSON);
        $error = false;
        $messages = [];
        $request = $this->getRequest();
        $items = $request->getParam('items', []);
        if (!($request->getParam('isAjax') && count($items))) {
            return $resultJson->setData(['messages' => [__('Please correct the data sent.')], 'error' => true]);
        }
        foreach (array_keys($items) as $vendorId) {
            $vendor = $this->vendorFactory->create();
            $vendor->load($vendorId);
            if (!$vendor->getId()) {
                continue;
            }
            try {
                $vendorData = $items[$vendorId];
                $vendor->fromArray($vendorData);
                $vendor->save();
            } catch (\Magento\Framework\Exception\LocalizedException $exception) {
                $messages[] = '[Vendor ID: '.$vendor->getId().'] '.$exception->getMessage();
                $error = true;
            } catch (\Exception $exception) {
                $messages[] = '[Vendor ID: '.$vendor->getId().'] '.__('Something went wrong while saving the vendor.');
                $error = true;
            }
        }
        return $resultJson->setData(['messages' => $messages, 'error' => $error]);
    }
    
}