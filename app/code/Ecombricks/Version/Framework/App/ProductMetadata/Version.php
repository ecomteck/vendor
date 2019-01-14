<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Version\Framework\App\ProductMetadata;

/**
 * Version product metadata
 */
class Version
{
    
    /**
     * Product metadata
     * 
     * @var \Magento\Framework\App\ProductMetadata
     */
    protected $productMetadata;
    
    /**
     * Version
     * 
     * @var string
     */
    protected $version;
    
    /**
     * List of versions
     * 
     * @var string[]
     */
    protected $list;
    
    /**
     * History list of versions
     * 
     * @var string[] 
     */
    protected $historyList;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\App\ProductMetadata $productMetadata
     * @return void
     */
    public function __construct(
        \Magento\Framework\App\ProductMetadata $productMetadata
    )
    {
        $this->productMetadata = $productMetadata;
    }
    
    /**
     * Get the current version
     * 
     * @return string
     */
    public function get()
    {
        if ($this->version !== null) {
            return $this->version;
        }
        $this->version = $this->productMetadata->getVersion();
        return $this->version;
    }
    
    /**
     * Compare a version to the current version
     * 
     * @param string $version
     * @param string $operator
     * @return int
     */
    public function compare($version, $operator = null)
    {
        return version_compare($this->get(), $version, $operator);
    }
    
    /**
     * Check if the current version is greater than or equal to a given version
     * 
     * @param string $version
     * @return bool
     */
    public function isGe($version)
    {
        return $this->compare($version, '>=');
    }
    
    /**
     * Check if the current version is less than or equal to a given version
     * 
     * @param string $version
     * @return bool
     */
    public function isLe($version)
    {
        return $this->compare($version, '<=');
    }
    
    /**
     * Check if the current version is greater than a given version
     * 
     * 
     * @param string $version
     * @return bool
     */
    public function isGt($version)
    {
        return $this->compare($version, '>');
    }
    
    /**
     * Check if the current version is less than a given version
     * 
     * @param string $version
     * @return bool
     */
    public function isLt($version)
    {
        return $this->compare($version, '<');
    }
    
}