<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorUi\Plugin\Framework\View\Element;

/**
 * Ui component factory plugin
 */
class UiComponentFactory extends \Ecombricks\Vendor\Framework\Plugin\AbstractFactoryPlugin
{
    
    /**
     * Around create
     * 
     * @param \Magento\Framework\View\Element\UiComponentFactory $subject
     * @param \Closure $proceed
     * @param string $identifier
     * @param string $name
     * @param array $arguments
     * @return \Magento\Framework\View\Element\UiComponentInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundCreate(
        \Magento\Framework\View\Element\UiComponentFactory $subject,
        \Closure $proceed,
        $identifier,
        $name = null,
        array $arguments = []
    )
    {
        $result = $proceed($identifier, $name, $arguments);
        $this
            ->setSubject($subject)
            ->setVendorId($result->getContext()->getDataProvider());
        return $result;
    }
    
}