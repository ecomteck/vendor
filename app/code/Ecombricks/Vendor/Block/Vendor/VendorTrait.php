<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor;

/**
 * Vendor block vendor trait
 */
trait VendorTrait
{
    
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $registry;
    
    /**
     * Review renderer
     * 
     * @var \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface
     */
    protected $reviewRenderer;
    
    /**
     * Get vendor
     *
     * @return \Ecombricks\Vendor\Model\Vendor
     */
    public function getVendor()
    {
        if (!$this->hasData('vendor')) {
            $this->setData('vendor', $this->registry->registry('vendor'));
        }
        return $this->getData('vendor');
    }
    
    /**
     * Get vendor ID
     * 
     * @return int|null
     */
    public function getVendorId()
    {
        $vendor = $this->getVendor();
        return ($vendor) ? $vendor->getId() : null;
    }
    
    /**
     * Get vendor code
     * 
     * @return string|null
     */
    public function getVendorCode()
    {
        $vendor = $this->getVendor();
        return ($vendor) ? $vendor->getCode() : null;
    }
    
    /**
     * Get vendor name
     * 
     * @return string|null
     */
    public function getVendorName()
    {
        $vendor = $this->getVendor();
        return ($vendor) ? $vendor->getName() : null;
    }
    
    /**
     * Get vendor URL
     * 
     * @param string $route
     * @return string
     */
    public function getVendorUrl($route = '')
    {
        $vendor = $this->getVendor();
        $params = ($vendor) ? ['code' => $vendor->getCode()] : [];
        return $this->getUrl($route, $params);
    }
    
    /**
     * Get identifiers
     *
     * @return array
     */
    public function getIdentities()
    {
        $vendor = $this->getVendor();
        return ($vendor) ? $vendor->getIdentities() : [\Ecombricks\Vendor\Model\Vendor::CACHE_TAG];
    }
    
    /**
     * Get vendor reviews summary HTML
     *
     * @param \Ecombricks\Vendor\Model\Vendor $vendor
     * @param bool $templateType
     * @param bool $displayIfNoReviews
     * @return string
     */
    public function getVendorReviewsSummaryHtml(
        \Ecombricks\Vendor\Model\Vendor $vendor,
        $templateType = false,
        $displayIfNoReviews = false
    )
    {
        return $this->reviewRenderer->getVendorReviewsSummaryHtml($vendor, $templateType, $displayIfNoReviews);
    }

}