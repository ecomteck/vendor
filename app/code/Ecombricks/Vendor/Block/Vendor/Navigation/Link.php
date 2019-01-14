<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor\Navigation;

/**
 * Vendor navigation link block
 */
class Link extends \Magento\Framework\View\Element\Html\Link\Current implements \Magento\Framework\DataObject\IdentityInterface 
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
     * @param \Magento\Framework\App\DefaultPathInterface $defaultPath
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\DefaultPathInterface $defaultPath,
        \Magento\Framework\Registry $registry,
        array $data = []
    )
    {
        $this->registry = $registry;
        parent::__construct($context, $defaultPath, $data);
    }
    
    /**
     * Get href URL
     * 
     * @return string
     */
    public function getHref()
    {
        return $this->getVendorUrl($this->getPath());
    }
    
}