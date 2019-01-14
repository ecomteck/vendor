<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Interception\Framework\ObjectManager\Code\Generator;

/**
 * Proxy code generator
 */
class Proxy extends \Magento\Framework\ObjectManager\Code\Generator\Proxy
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
     * Get class methods
     * 
     * @return array
     */
    protected function _getClassMethods()
    {
        $classMethods = parent::_getClassMethods();
        $traits = $this->interceptionConfig->getTraits($this->getSourceClassName());
        if (empty($traits)) {
            return $classMethods;
        }
        $classMethodNames = [];
        foreach ($classMethods as $classMethod) {
            $classMethodNames[$classMethod['name']] = $classMethod['name'];
        }
        foreach ($traits as $trait) {
            $traitClass = new \ReflectionClass('\\'.$trait['type']);
            $traitMethods = $traitClass->getMethods();
            foreach ($traitMethods as $traitMethod) {
                $traitMethodName = $traitMethod->getName();
                if (!empty($classMethodNames[$traitMethodName])) {
                    continue;
                }
                if (
                    !(
                        $traitMethod->isConstructor() ||  
                        $traitMethod->isFinal() || 
                        $traitMethod->isStatic() || 
                        $traitMethod->isDestructor()
                    ) && !in_array($traitMethodName, ['__sleep', '__wakeup', '__clone'])
                ) {
                    $classMethods[] = $this->_getMethodInfo($traitMethod);
                    $classMethodNames[$traitMethodName] = $traitMethodName;
                }
            }
        }
        return $classMethods;
    }
    
}