<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Interception\Framework\Code\Reader;

/**
 * Class reader
 */
class ClassReader extends \Magento\Framework\Code\Reader\ClassReader
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
     * @param \Ecombricks\Interception\Config\Config\Proxy $interceptionInterceptionConfig
     * @param \Magento\Setup\Module\Di\Code\Reader\Type $interceptionTypeReader
     * @param \Magento\Framework\ObjectManager\InterceptableValidator $interceptionInterceptableValidator
     * @return void
     */
    public function __construct(
        \Ecombricks\Interception\Config\Config\Proxy $interceptionInterceptionConfig,
        \Magento\Setup\Module\Di\Code\Reader\Type $interceptionTypeReader,
        \Magento\Framework\ObjectManager\InterceptableValidator $interceptionInterceptableValidator
    )
    {
        $this->interceptionInterceptionConfig = $interceptionInterceptionConfig;
        $this->interceptionTypeReader = $interceptionTypeReader;
        $this->interceptionInterceptableValidator = $interceptionInterceptableValidator;
    }
    
    /**
     * Append parameters
     * 
     * @param array $result
     * @param array $parameters
     * @return $this
     */
    protected function appendParameters(&$result, $parameters)
    {
        if (empty($parameters)) {
            return $this;
        }
        foreach ($parameters as $parameter) {
            if ($parameter[2]) {
                $result[] = $parameter;
            }
        }
        foreach ($parameters as $parameter) {
            if (!$parameter[2]) {
                $result[] = $parameter;
            }
        }
        return $this;
    }
    
    /**
     * Add parameters
     * 
     * @param array $result
     * @param array $parameters
     * @return $this
     */
    protected function addParameters(&$result, $parameters)
    {
        $newResult = [];
        $parametersAdded = false;
        foreach ($result as $parameter) {
            if (!$parametersAdded && !$parameter[2]) {
                $this->appendParameters($newResult, $parameters);
                $parametersAdded = true;
            }
            $newResult[] = $parameter;
        }
        if (!$parametersAdded) {
            $this->appendParameters($newResult, $parameters);
        }
        $result = $newResult;
        return $this;
    }
    
    /**
     * Get constructor
     *
     * @param string $className
     * @return array|null
     * @throws \ReflectionException
     */
    public function getConstructor($className)
    {
        $result = parent::getConstructor($className);
        if (
            !$this->interceptionTypeReader->isConcrete($className) || 
            !$this->interceptionInterceptableValidator->validate($className)
        ) {
            return $result;
        }
        $properties = $this->interceptionInterceptionConfig->getProperties($className);
        if (empty($properties)) {
            return $result;
        }
        $parameters = [];
        foreach ($properties as $property) {
            if ($property['type'] == 'copy') {
                continue;
            }
            $type = ($property['type'] == 'object') ? '\\'.$this->interceptionInterceptionConfig->castTypeName($property['value']) : null;
            $isRequired = ($property['type'] != 'object') ? ($property['value'] === null ? true : false) : true;
            $defaultValue = (!$isRequired) ? $this->interceptionInterceptionConfig->castValue($property['type'], $property['value']) : null;
            $parameters[] = [
                $property['name'],
                $type,
                $isRequired,
                $defaultValue
            ];
        }
        if ($result === null) {
            $result = [];
        }
        $this->addParameters($result, $parameters);
        return $result;
    }
    
}