<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier;

/**
 * Vendor form data provider system modifier
 */
class System extends \Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier\AbstractModifier
{
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Vendor\Model\Locator\LocatorInterface $locator
     * @param \Magento\Framework\Stdlib\ArrayManager $arrayManager
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @return void
     */
    public function __construct(
        \Ecombricks\Vendor\Model\Locator\LocatorInterface $locator,
        \Magento\Framework\Stdlib\ArrayManager $arrayManager,
        \Magento\Framework\UrlInterface $urlBuilder
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct(
            $locator,
            $arrayManager
        );
    }
    
    /**
     * Modify assigned data
     * 
     * @return $this
     */
    protected function modifyAssignedData()
    {
        $this->setData($this->urlBuilder->getUrl('vendor/vendor/save', ['vendor_id' => $this->getVendorId()]), 'config/submit_url');
        return $this;
    }
    
}