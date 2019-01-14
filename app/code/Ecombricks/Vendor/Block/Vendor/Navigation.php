<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor;

/**
 * Vendor navigation block
 */
class Navigation extends \Magento\Framework\View\Element\Html\Links implements \Magento\Framework\DataObject\IdentityInterface 
{
    
    use \Ecombricks\Vendor\Block\Vendor\VendorTrait;
    
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
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
    
}