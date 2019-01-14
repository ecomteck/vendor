<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorContact\Controller\Index;

/**
 * Contact post controller
 */
class Post extends \Magento\Contact\Controller\Index\Post
{
    
    use \Ecombricks\Vendor\Controller\Vendor\VendorTrait;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Magento\Contact\Model\ConfigInterface $contactsConfig
     * @param \Magento\Contact\Model\MailInterface $mail
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Contact\Model\ConfigInterface $contactsConfig,
        \Magento\Contact\Model\MailInterface $mail,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
    )
    {
        $this->registry = $registry;
        $this->vendorManagement = $vendorManagement;
        parent::__construct($context, $contactsConfig, $mail, $dataPersistor, $logger);
    }
    
    /**
     * Dispatch
     *
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Framework\App\ResponseInterface
     * @throws \Magento\Framework\Exception\NotFoundException
     */
    public function dispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $vendor = $this->vendorInit();
        if (!$vendor) {
            throw new \Magento\Framework\Exception\NotFoundException(__('Vendor not found.'));
        }
        return parent::dispatch($request);
    }

    /**
     * Execute
     * 
     * @return void
     * @throws \Exception
     */
    public function execute()
    {
        $request = $this->getRequest();
        $data = $request->getPostValue();
        if (empty($data)) {
            return $this->resultRedirectFactory->create()->setPath('*/*/');
        }
        $vendor = $this->getVendor();
        $resultRedirect = parent::execute();
        $resultRedirect->setPath('vendor_contact/index/index', ['code' => $vendor->getCode()]);
        return $resultRedirect;
    }
    
}