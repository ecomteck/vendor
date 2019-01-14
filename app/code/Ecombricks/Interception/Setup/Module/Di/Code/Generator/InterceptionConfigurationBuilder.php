<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Interception\Setup\Module\Di\Code\Generator;

/**
 * Interception configuration builder
 */
class InterceptionConfigurationBuilder extends \Magento\Setup\Module\Di\Code\Generator\InterceptionConfigurationBuilder
{
    
    /**
     * Interception configuration
     * 
     * @var \Ecombricks\Interception\Config\Config\Proxy
     */
    protected $interceptionInterceptionConfig;
    
    /**
     * Type reader
     * 
     * @var \Magento\Setup\Module\Di\Code\Reader\Type
     */
    protected $interceptionTypeReader;

    /**
     * Interceptable validator
     * 
     * @var \Magento\Framework\ObjectManager\InterceptableValidator
     */
    protected $interceptionInterceptableValidator;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Interception\Config\Config $interceptionConfig
     * @param \Magento\Setup\Module\Di\Code\Generator\PluginList $pluginList
     * @param \Magento\Setup\Module\Di\Code\Reader\Type $typeReader
     * @param \Magento\Framework\App\Cache\Manager $cacheManager
     * @param \Magento\Framework\ObjectManager\InterceptableValidator $interceptableValidator
     * @param \Ecombricks\Interception\Config\Config\Proxy $interceptionInterceptionConfig
     * @param \Magento\Setup\Module\Di\Code\Reader\Type $interceptionTypeReader
     * @param \Magento\Framework\ObjectManager\InterceptableValidator $interceptionInterceptableValidator
     * @return void
     */
    public function __construct(
        \Magento\Framework\Interception\Config\Config $interceptionConfig,
        \Magento\Setup\Module\Di\Code\Generator\PluginList $pluginList,
        \Magento\Setup\Module\Di\Code\Reader\Type $typeReader,
        \Magento\Framework\App\Cache\Manager $cacheManager,
        \Magento\Framework\ObjectManager\InterceptableValidator $interceptableValidator,
        \Ecombricks\Interception\Config\Config\Proxy $interceptionInterceptionConfig,
        \Magento\Setup\Module\Di\Code\Reader\Type $interceptionTypeReader,
        \Magento\Framework\ObjectManager\InterceptableValidator $interceptionInterceptableValidator
    )
    {
        parent::__construct($interceptionConfig, $pluginList, $typeReader, $cacheManager, $interceptableValidator);
        $this->interceptionInterceptionConfig = $interceptionInterceptionConfig;
        $this->interceptionTypeReader = $interceptionTypeReader;
        $this->interceptionInterceptableValidator = $interceptionInterceptableValidator;
    }
    
    /**
     * Get trait methods
     * 
     * @param array $definedClasses
     * @param array $interceptionConfiguration
     * @return array
     */
    protected function getTraitMethods($definedClasses, $interceptionConfiguration)
    {
        foreach ($definedClasses as $definedClass) {
            if (
                !$this->interceptionTypeReader->isConcrete($definedClass) || 
                !$this->interceptionInterceptableValidator->validate($definedClass)
            ) {
                continue;
            }
            $traitMethods = array_keys($this->interceptionInterceptionConfig->getTraitMethods($definedClass));
            if (empty($traitMethods)) {
                continue;
            }
            if (empty($interceptionConfiguration[$definedClass])) {
                $interceptionConfiguration[$definedClass] = [];
            }
            foreach ($traitMethods as $traitMethod) {
                if (!in_array($traitMethod, $interceptionConfiguration[$definedClass])) {
                    $interceptionConfiguration[$definedClass][] = $traitMethod;
                }
            }
        }
        return $interceptionConfiguration;
    }
    
    /**
     * Get interception configuration
     * 
     * @param array $definedClasses
     * @return array
     */
    public function getInterceptionConfiguration($definedClasses)
    {
        $configuration = parent::getInterceptionConfiguration($definedClasses);
        return $this->getTraitMethods($definedClasses, $configuration);
    }
    
}