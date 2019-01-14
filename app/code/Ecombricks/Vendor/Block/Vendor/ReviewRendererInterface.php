<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Block\Vendor;

/**
 * Vendor review renderer block interface
 */
interface ReviewRendererInterface
{
    
    const SHORT_VIEW = 'short';
    const FULL_VIEW = 'default';
    const DEFAULT_VIEW = self::FULL_VIEW;
    
    /**
     * Get vendor review summary HTML
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
    );
    
}