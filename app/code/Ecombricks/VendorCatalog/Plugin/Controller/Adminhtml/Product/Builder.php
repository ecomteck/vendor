<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Controller\Adminhtml\Product;

/**
 * Controller product builder plugin
 */
class Builder extends \Ecombricks\Vendor\Framework\Plugin\AbstractPlugin
{
    
    /**
     * Around build
     * 
     * @param \Magento\Catalog\Controller\Adminhtml\Product\Builder $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\App\RequestInterface $request
     * @return \Magento\Catalog\Model\Product
     */
    public function aroundBuild(
        \Magento\Catalog\Controller\Adminhtml\Product\Builder $subject,
        \Closure $proceed,
        \Magento\Framework\App\RequestInterface $request
    )
    {
        $result = $proceed($request);
        if ($subject->getVendorId()) {
            return $result;
        }
        $this
            ->setSubject($subject)
            ->copyVendorId($result, $subject);
        return $result;
    }
    
}