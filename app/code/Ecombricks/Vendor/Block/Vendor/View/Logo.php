<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor\View;

/**
 * Vendor logo block
 */
class Logo extends \Ecombricks\Vendor\Block\Vendor\AbstractVendor 
{
    
    /**
     * Logo
     * 
     * @var \Ecombricks\Vendor\Model\Vendor\Logo
     */
    protected $logo;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface $reviewRenderer
     * @param \Ecombricks\Vendor\Model\Vendor\Logo $logo
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface $reviewRenderer,
        \Ecombricks\Vendor\Model\Vendor\Logo $logo,
        array $data = []
    )
    {
        $this->logo = $logo;
        parent::__construct(
            $context,
            $registry,
            $reviewRenderer,
            $data
        );
    }
    
    /**
     * Get logo URL
     * 
     * @return string
     */
    public function getLogoUrl()
    {
        $logo = $this->getVendor()->getLogo();
        return ($logo) ? $this->logo->getUrl($logo) : $this->logo->getDefaultUrl();
    }
    
    /**
     * Get logo width
     * 
     * @return int
     */
    public function getLogoWidth()
    {
        return \Ecombricks\Vendor\Model\Vendor\Logo::WIDTH;
    }
    
    /**
     * Get logo height
     * 
     * @return int
     */
    public function getLogoHeight()
    {
        return \Ecombricks\Vendor\Model\Vendor\Logo::WIDTH;
    }
    
}