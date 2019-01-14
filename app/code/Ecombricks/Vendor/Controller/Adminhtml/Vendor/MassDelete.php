<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Controller\Adminhtml\Vendor;

/**
 * Mass delete vendor controller
 */
class MassDelete extends \Ecombricks\Vendor\Controller\Adminhtml\Vendor
{
    
    /**
     * Mass action filter
     * 
     * @var \Magento\Ui\Component\MassAction\Filter
     */
    protected $filter;
    
    /**
     * Vendor collection factory
     * 
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory
     */
    protected $vendorCollectionFactory;
    
    /**
     * Constructor
     * 
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Ecombricks\Vendor\Model\VendorFactory $vendorFactory
     * @param \Magento\Ui\Component\MassAction\Filter $filter
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
     * @return void
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context, 
        \Magento\Framework\Registry $coreRegistry,
        \Ecombricks\Vendor\Model\VendorFactory $vendorFactory,
        \Magento\Ui\Component\MassAction\Filter $filter,
        \Ecombricks\Vendor\Model\ResourceModel\Vendor\CollectionFactory $vendorCollectionFactory
    )
    {
        $this->filter = $filter;
        $this->vendorCollectionFactory = $vendorCollectionFactory;
        parent::__construct($context, $coreRegistry, $vendorFactory);
    }
    
    /**
     * Execute
     * 
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @throws \Magento\Framework\Exception\LocalizedException|\Exception
     */
    public function execute()
    {
        $vendorCollection = $this->filter->getCollection($this->vendorCollectionFactory->create());
        $vendorCounter = 0;
        foreach ($vendorCollection as $vendor) {
            try {
                $vendor->delete();
                $vendorCounter++;
            } catch (\Magento\Framework\Exception\LocalizedException $exception) {
                $this->messageManager->addError($exception->getMessage());
            } catch (\Exception $exception) {
                $this->messageManager->addExceptionMessage($exception, __('Something went wrong while deleting the vendor (ID = %1).', $vendor->getId()));
            }
        }
        if ($vendorCounter > 0) {
            $this->messageManager->addSuccess(__('A total of %1 record(s) have been deleted.', $vendorCounter));
        }
        $resultRedirect = $this->resultFactory->create(\Magento\Framework\Controller\ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
    
}