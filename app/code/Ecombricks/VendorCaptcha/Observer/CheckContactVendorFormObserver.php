<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCaptcha\Observer;

/**
 * Check contact vendor form observer
 */
class CheckContactVendorFormObserver implements \Magento\Framework\Event\ObserverInterface
{
    
    /**
     * Captcha helper
     * 
     * @var \Magento\Captcha\Helper\Data
     */
    protected $captchaHelper;
    
    /**
     * Action flag
     * 
     * @var \Magento\Framework\App\ActionFlag
     */
    protected $actionFlag;

    /**
     * Message manager
     * 
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * Redirect
     * 
     * @var \Magento\Framework\App\Response\RedirectInterface
     */
    protected $redirect;
    
    /**
     * Captcha string resolver
     * 
     * @var \Magento\Captcha\Observer\CaptchaStringResolver
     */
    protected $captchaStringResolver;
    
    /**
     * Data persistor
     * 
     * @var \Magento\Framework\App\Request\DataPersistorInterface
     */
    protected $dataPersistor;
    
    /**
     * Registry
     * 
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Constructor
     * 
     * @param \Magento\Captcha\Helper\Data $captchaHelper
     * @param \Magento\Framework\App\ActionFlag $actionFlag
     * @param \Magento\Framework\Message\ManagerInterface $messageManager
     * @param \Magento\Framework\App\Response\RedirectInterface $redirect
     * @param \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     * @param \Magento\Framework\Registry $registry
     * @return void
     */
    public function __construct(
        \Magento\Captcha\Helper\Data $captchaHelper,
        \Magento\Framework\App\ActionFlag $actionFlag,
        \Magento\Framework\Message\ManagerInterface $messageManager,
        \Magento\Framework\App\Response\RedirectInterface $redirect,
        \Magento\Captcha\Observer\CaptchaStringResolver $captchaStringResolver,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Magento\Framework\Registry $registry
    )
    {
        $this->captchaHelper = $captchaHelper;
        $this->actionFlag = $actionFlag;
        $this->messageManager = $messageManager;
        $this->redirect = $redirect;
        $this->captchaStringResolver = $captchaStringResolver;
        $this->dataPersistor = $dataPersistor;
        $this->registry = $registry;
    }
    
    /**
     * Get vendor
     * 
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    protected function getVendor()
    {
        return $this->registry->registry('vendor');
    }

    /**
     * Execute
     *
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $captcha = $this->captchaHelper->getCaptcha('contact_vendor');
        if (!$captcha || !$captcha->isRequired()) {
            return;
        }
        $controller = $observer->getControllerAction();
        $request = $controller->getRequest();
        if ($captcha->isCorrect($this->captchaStringResolver->resolve($request, 'contact_vendor'))) {
            return;
        }
        $this->messageManager->addError(__('Incorrect CAPTCHA.'));
        $this->dataPersistor->set('contact_us', $request->getPostValue());
        $this->actionFlag->set('', \Magento\Framework\App\Action\Action::FLAG_NO_DISPATCH, true);
        $this->redirect->redirect($controller->getResponse(), 'vendor_contact/index/index', ['code' => $this->getVendor()->getCode()]);
    }
    
}