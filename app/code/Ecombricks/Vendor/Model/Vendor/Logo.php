<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\Vendor;

/**
 * Vendor logo
 */
class Logo extends \Ecombricks\Vendor\Model\Vendor\Image
{
    
    /**
     * Constructor
     *
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\View\Asset\Repository $assetRepository
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Image\Factory $imageFactory
     * @param \Ecombricks\Vendor\Model\Vendor\Image\Uploader $uploader
     * @return void
     */
    public function __construct(
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\View\Asset\Repository $assetRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Image\Factory $imageFactory,
        \Ecombricks\Vendor\Model\Vendor\Image\Uploader\Proxy $uploader
    )
    {
        parent::__construct(
            $filesystem,
            $assetRepository,
            $storeManager,
            $imageFactory,
            $uploader,
            'logo',
            ['red' => 255, 'green' => 255, 'blue' => 255],
            ['width' => self::WIDTH, 'height' => self::HEIGHT]
        );
    }
    
}