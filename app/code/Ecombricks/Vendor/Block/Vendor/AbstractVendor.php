<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor;

/**
 * Abstract vendor block
 */
class AbstractVendor extends \Magento\Framework\View\Element\Template implements \Magento\Framework\DataObject\IdentityInterface 
{
    
    use \Ecombricks\Vendor\Block\Vendor\VendorTrait;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface $reviewRenderer
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface $reviewRenderer,
        array $data = []
    )
    {
        $this->registry = $registry;
        $this->reviewRenderer = $reviewRenderer;
        parent::__construct($context, $data);
    }
    
}