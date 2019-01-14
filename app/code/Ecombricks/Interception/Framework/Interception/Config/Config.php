<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Interception\Framework\Interception\Config;

/**
 * Interception configuration
 */
class Config extends \Magento\Framework\Interception\Config\Config
{
    
    /**
     * Interception configuration
     * 
     * @var \Ecombricks\Interception\Config\Config\Proxy
     */
    protected $interceptionConfig;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Config\ReaderInterface $reader
     * @param \Magento\Framework\Config\ScopeListInterface $scopeList
     * @param \Magento\Framework\Cache\FrontendInterface $cache
     * @param \Magento\Framework\ObjectManager\RelationsInterface $relations
     * @param \Magento\Framework\Interception\ObjectManager\ConfigInterface $omConfig
     * @param \Magento\Framework\ObjectManager\DefinitionInterface $classDefinitions
     * @param \Ecombricks\Interception\Config\Config\Proxy $interceptionConfig
     * @param string $cacheId
     * @return void
     */
    public function __construct(
        \Magento\Framework\Config\ReaderInterface $reader,
        \Magento\Framework\Config\ScopeListInterface $scopeList,
        \Magento\Framework\Cache\FrontendInterface $cache,
        \Magento\Framework\ObjectManager\RelationsInterface $relations,
        \Magento\Framework\Interception\ObjectManager\ConfigInterface $omConfig,
        \Magento\Framework\ObjectManager\DefinitionInterface $classDefinitions,
        \Ecombricks\Interception\Config\Config\Proxy $interceptionConfig,
        $cacheId = 'interception'
    )
    {
        $this->interceptionConfig = $interceptionConfig;
        parent::__construct($reader, $scopeList, $cache, $relations, $omConfig, $classDefinitions, $cacheId);
    }
    
    /**
     * Initialize
     *
     * @param array $classDefinitions
     * @return void
     */
    public function initialize($classDefinitions = [])
    {
        foreach ($this->interceptionConfig->getTypes() as $type) {
            $this->_intercepted[$type] = true;
        }
        parent::initialize($classDefinitions);
    }
    
}