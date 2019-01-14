<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorContact\Block;

/**
 * Vendor contact form block
 */
class ContactForm extends \Magento\Contact\Block\ContactForm
{
    
    use \Ecombricks\Vendor\Block\Vendor\VendorTrait;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->registry = $registry;
        parent::__construct($context, $data);
    }
    
    /**
     * Get form action
     * 
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('vendor_contact/index/post', ['_secure' => true, 'code' => $this->getVendorCode()]);
    }
    
}