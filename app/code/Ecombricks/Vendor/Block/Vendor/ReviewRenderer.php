<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor;

/**
 * Vendor review renderer block
 */
class ReviewRenderer extends \Magento\Framework\View\Element\Template 
    implements \Ecombricks\Vendor\Block\Vendor\ReviewRendererInterface
{
    
    /**
     * Get vendor reviews summary html
     *
     * @param \Ecombricks\Vendor\Model\Vendor $vendor
     * @param string $templateType
     * @param bool $displayIfNoReviews
     * @return string
     */
    public function getVendorReviewsSummaryHtml(
        \Ecombricks\Vendor\Model\Vendor $vendor,
        $templateType = self::DEFAULT_VIEW,
        $displayIfNoReviews = false
    )
    {
        return '';
    }
    
}