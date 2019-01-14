<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Interception\Setup\Module\Di\Code\Generator;

/**
 * Interceptor code generator
 */
class Interceptor extends \Magento\Setup\Module\Di\Code\Generator\Interceptor
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
     * @param null|string $sourceClassName
     * @param null|string $resultClassName
     * @param null|\Magento\Framework\Code\Generator\Io $ioObject
     * @param null|\Magento\Framework\Code\Generator\CodeGeneratorInterface $classGenerator
     * @param null|\Magento\Framework\Code\Generator\DefinedClasses $definedClasses
     * @param null|\Ecombricks\Interception\Config\Config\Proxy $interceptionConfig
     * @return void
     */
    public function __construct(
        $sourceClassName = null,
        $resultClassName = null,
        \Magento\Framework\Code\Generator\Io $ioObject = null,
        \Magento\Framework\Code\Generator\CodeGeneratorInterface $classGenerator = null,
        \Magento\Framework\Code\Generator\DefinedClasses $definedClasses = null,
        \Ecombricks\Interception\Config\Config\Proxy $interceptionConfig = null
    )
    {
        parent::__construct($sourceClassName, $resultClassName, $ioObject, $classGenerator, $definedClasses);
        if ($interceptionConfig) {
            $this->interceptionConfig = $interceptionConfig;
        } else {
            $this->interceptionConfig = \Magento\Framework\App\ObjectManager::getInstance()
                ->get(\Ecombricks\Interception\Config\Config\Proxy::class);
        }
    }
    
    /**
     * Generate code
     *
     * @return string
     */
    protected function _generateCode()
    {
        $sourceClassName = $this->getSourceClassName();
        foreach ($this->interceptionConfig->getTraits($sourceClassName) as $trait) {
            $this->_classGenerator->addTrait('\\'.$trait['type']);
        }
        foreach ($this->interceptionConfig->getTraitOverrides($sourceClassName) as $traitMethod => $traitTypes) {
            foreach ($traitTypes as $traitType) {
                $this->_classGenerator->addTraitOverride('\\'.$traitMethod, '\\'.$traitType);
            }
        }
        return parent::_generateCode();
    }
    
    /**
     * Get class methods
     * 
     * @return array
     */
    protected function _getClassMethods()
    {
        $classMethods = parent::_getClassMethods();
        $sourceClassName = $this->getSourceClassName();
        $properties = $this->interceptionConfig->getProperties($sourceClassName);
        if (empty($properties)) {
            return $classMethods;
        }
        foreach ($classMethods as &$classMethod) {
            if ($classMethod['name'] != '__construct') {
                continue;
            }
            $this->interceptionConfig->addClassPropertyParameters($sourceClassName, $classMethod['parameters']);
            $body = '';
            foreach ($properties as $property) {
                if ($property['type'] != 'copy') {
                    $propertyVarName = $property['name'];
                } else {
                    $propertyVarName = $property['value'];
                }
                $body .= "\$this->{$property['name']} = \${$propertyVarName};".PHP_EOL;
            }
            $classMethod['body'] = $body.$classMethod['body'];
            break;
        }
        return $classMethods;
    }
    
    /**
     * Get class properties
     * 
     * @return array
     */
    protected function _getClassProperties()
    {
        $classProperties = parent::_getClassProperties();
        $properties = $this->interceptionConfig->getClassProperties($this->getSourceClassName());
        if (empty($properties)) {
            return $classProperties;
        }
        return array_merge($classProperties, $properties);
    }
    
}