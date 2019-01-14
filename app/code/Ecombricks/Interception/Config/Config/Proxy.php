<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Interception\Config\Config;

/**
 * Interception configuration proxy
 */
class Proxy extends \Ecombricks\Interception\Config\Config 
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
     * @var \Ecombricks\Interception\Config\Config
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
     * @return \Ecombricks\Interception\Config\Config
     */
    protected function _getSubject()
    {
        if (!$this->_subject) {
            $this->_subject = $this->_objectManager->get(\Ecombricks\Interception\Config\Config::class);
        }
        return $this->_subject;
    }
    
    /**
     * Cast type name
     * 
     * @param string $type
     * @return string
     */
    public function castTypeName($type)
    {
        return $this->_getSubject()->castTypeName($type);
    }
    
    /**
     * Get traits
     * 
     * @param string $type
     * @return array
     */
    public function getTraits($type)
    {
        return $this->_getSubject()->getTraits($type);
    }
    
    /**
     * Get properties
     * 
     * @param string $type
     * @return array
     */
    public function getProperties($type)
    {
        return $this->_getSubject()->getProperties($type);
    }
    
    /**
     * Get types
     * 
     * @return array
     */
    public function getTypes()
    {
        return $this->_getSubject()->getTypes();
    }
    
    /**
     * Cast value
     * 
     * @param string $type
     * @param mixed $value
     * @return mixed
     */
    public function castValue($type, $value)
    {
        return $this->_getSubject()->castValue($type, $value);
    }
    
    /**
     * Get trait methods
     * 
     * @param string $type
     * @return array
     */
    public function getTraitMethods($type)
    {
        return $this->_getSubject()->getTraitMethods($type);
    }
    
    /**
     * Get trait overrides
     * 
     * @param string $type
     * @return array
     */
    public function getTraitOverrides($type)
    {
        return $this->_getSubject()->getTraitOverrides($type);
    }
    
    /**
     * Get class property parameters
     * 
     * @param string $type
     * @return array
     */
    public function getClassPropertyParameters($type)
    {
        return $this->_getSubject()->getClassPropertyParameters($type);
    }
    
    /**
     * Add class property parameters
     * 
     * @param string $type
     * @param array $parameters
     * @return $this
     */
    public function addClassPropertyParameters($type, &$parameters)
    {
        return $this->_getSubject()->addClassPropertyParameters($type, $parameters);
    }
    
    /**
     * Get class properties
     * 
     * @param string $type
     * @return array
     */
    public function getClassProperties($type)
    {
        return $this->_getSubject()->getClassProperties($type);
    }
    
}