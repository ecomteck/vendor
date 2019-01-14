<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Version\Framework\App\ProductMetadata\Version;

/**
 * Version product metadata proxy
 */
class Proxy extends \Ecombricks\Version\Framework\App\ProductMetadata\Version 
{
    
    /**
     * Object manager
     * 
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;
    
    /**
     * Subject
     * 
     * @var \Ecombricks\Version\Framework\App\ProductMetadata\Version
     */
    protected $_subject;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\ObjectManagerInterface $objectManger
     * @return void
     */
    public function __construct(\Magento\Framework\ObjectManagerInterface $objectManger)
    {
        $this->_objectManager = $objectManger;
    }
    
    /**
     * Get subject
     *
     * @return \Ecombricks\Version\Framework\App\ProductMetadata\Version
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = $this->_objectManager->get(\Ecombricks\Version\Framework\App\ProductMetadata\Version::class);
        }
        return $this->_subject;
    }
    
    /**
     * Get the current version
     * 
     * @return string
     */
    public function get()
    {
        return $this->_getSubject()->get();
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
        return $this->_getSubject()->compare($version, $operator);
    }
    
    /**
     * Check if the current version is greater than or equal to a given version
     * 
     * @param string $version
     * @return bool
     */
    public function isGe($version)
    {
        return $this->_getSubject()->isGe($version);
    }
    
    /**
     * Check if the current version is less than or equal to a given version
     * 
     * @param string $version
     * @return bool
     */
    public function isLe($version)
    {
        return $this->_getSubject()->isLe($version);
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
        return $this->_getSubject()->isGt($version);
    }
    
    /**
     * Check if the current version is less than a given version
     * 
     * @param string $version
     * @return bool
     */
    public function isLt($version)
    {
        return $this->_getSubject()->isLt($version);
    }
    
}