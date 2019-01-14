<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Interception\Config;

/**
 * Interception configuration
 */
class Config
{
    
    /**
     * Data
     * 
     * @var \Ecombricks\Interception\Config\Data
     */
    protected $data;
    
    /**
     * Trait methods
     * 
     * @var array
     */
    protected $traitMethods = [];
    
    /**
     * Trait overrides
     * 
     * @var array
     */
    protected $traitOverrides = [];
    
    /**
     * Class property parameters
     * 
     * @var array
     */
    protected $classPropertyParameters = [];
    
    /**
     * Class properties
     * 
     * @var array
     */
    protected $classProperties = [];
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Interception\Config\Data $data
     * @return void
     */
    public function __construct(
        \Ecombricks\Interception\Config\Data $data
    )
    {
        $this->data = $data;
    }
    
    /**
     * Cast type name
     * 
     * @param string $type
     * @return string
     */
    public function castTypeName($type)
    {
        return ltrim($type, '\\');
    }
    
    /**
     * Get traits
     * 
     * @param string $type
     * @return array
     */
    public function getTraits($type)
    {
        return $this->data->getTraits($this->castTypeName($type));
    }
    
    /**
     * Get properties
     * 
     * @param string $type
     * @return array
     */
    public function getProperties($type)
    {
        return $this->data->getProperties($this->castTypeName($type));
    }
    
    /**
     * Get types
     * 
     * @return array
     */
    public function getTypes()
    {
        return $this->data->getTypes();
    }
    
    /**
     * Get value generator
     * 
     * @param string $type
     * @param mixed $value
     * @return \Zend\Code\Generator\ValueGenerator
     */
    protected function getValueGenerator($type, $value)
    {
        if ($value === 'null') {
            return new \Zend\Code\Generator\ValueGenerator(null, \Zend\Code\Generator\ValueGenerator::TYPE_NULL);
        }
        switch ($type) {
            case 'string' : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_STRING;
                break;
            case 'integer' : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_INTEGER;
                break;
            case 'float' : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_FLOAT;
                break;
            case 'boolean' : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_BOOLEAN;
                break;
            case 'array' : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_ARRAY_SHORT;
                break;
            case 'object' : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_OBJECT;
                break;
            default : 
                $valueGeneratorType = \Zend\Code\Generator\ValueGenerator::TYPE_AUTO;
                break;
        }
        return new \Zend\Code\Generator\ValueGenerator($value, $valueGeneratorType);
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
        if ($value === 'null') {
            return null;
        }
        switch ($type) {
            case 'string' : 
                $result = (string) $value;
                break;
            case 'integer' : 
                $result = (int) $value;
                break;
            case 'float' : 
                $result = (float) $value;
                break;
            case 'boolean' : 
                $result = (bool) $value;
                break;
            case 'array' : 
                $result = (array) $value;
                break;
            case 'object' : 
                $result = (string) $value;
                break;
            default : 
                $result = (string) $value;
                break;
        }
        return $result;
    }
    
    /**
     * Get trait methods
     * 
     * @param string $type
     * @return array
     */
    public function getTraitMethods($type)
    {
        if (array_key_exists($type, $this->traitMethods)) {
            return $this->traitMethods[$type];
        }
        $methods = [];
        $traits = $this->getTraits($type);
        if (empty($traits)) {
            return $methods;
        }
        foreach ($traits as $trait) {
            $traitType = $trait['type'];
            $traitMethods = get_class_methods('\\'.$traitType);
            if (empty($traitMethods)) {
                continue;
            }
            foreach ($traitMethods as $traitMethod) {
                if (empty($methods[$traitMethod])) {
                    $methods[$traitMethod] = [];
                }
                $methods[$traitMethod][] = $traitType;
            }
        }
        $this->traitMethods[$type] = $methods;
        return $this->traitMethods[$type];
    }
    
    /**
     * Get trait overrides
     * 
     * @param string $type
     * @return array
     */
    public function getTraitOverrides($type)
    {
        if (array_key_exists($type, $this->traitOverrides)) {
            return $this->traitOverrides[$type];
        }
        $overrides = [];
        $traitMethods = $this->getTraitMethods($type);
        if (empty($traitMethods)) {
            return $overrides;
        }
        foreach ($traitMethods as $traitMethod => $traitTypes) {
            if (count($traitTypes) == 1) {
                continue;
            }
            $traitType = array_pop($traitTypes);
            $overrides[$traitType.'::'.$traitMethod] = $traitTypes;
        }
        $this->traitOverrides[$type] = $overrides;
        return $this->traitOverrides[$type];
    }
    
    /**
     * Get class property parameters
     * 
     * @param string $type
     * @return array
     */
    public function getClassPropertyParameters($type)
    {
        if (array_key_exists($type, $this->classPropertyParameters)) {
            return $this->classPropertyParameters[$type];
        }
        $parameters = [];
        foreach ($this->getProperties($type) as $property) {
            if ($property['type'] == 'copy') {
                continue;
            }
            $parameter = [
                'name' => $property['name']
            ];
            if ($property['value'] !== null) {
                if ($property['type'] == 'object') {
                    $parameter['type'] = '\\'.$this->castTypeName($property['value']);
                } else {
                    $parameter['defaultValue'] = $this->getValueGenerator($property['type'], $property['value']);
                }
            }
            $parameters[] = $parameter;
        }
        $this->classPropertyParameters[$type] = $parameters;
        return $this->classPropertyParameters[$type];
    }
    
    /**
     * Append class property parameters
     * 
     * @param string $type
     * @param array $parameters
     * @return $this
     */
    protected function appendClassPropertyParameters($type, &$parameters)
    {
        $propertyParameters = $this->getClassPropertyParameters($type);
        if (empty($propertyParameters)) {
            return $this;
        }
        foreach ($propertyParameters as $propertyParameter) {
            if (!array_key_exists('defaultValue', $propertyParameter)) {
                $parameters[] = $propertyParameter;
            }
        }
        foreach ($propertyParameters as $propertyParameter) {
            if (array_key_exists('defaultValue', $propertyParameter)) {
                $parameters[] = $propertyParameter;
            }
        }
        return $this;
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
        $newParameters = [];
        $parametersAdded = false;
        foreach ($parameters as $parameter) {
            if (!$parametersAdded && array_key_exists('defaultValue', $parameter)) {
                $this->appendClassPropertyParameters($type, $newParameters);
                $parametersAdded = true;
            }
            $newParameters[] = $parameter;
        }
        if (!$parametersAdded) {
            $this->appendClassPropertyParameters($type, $newParameters);
        }
        $parameters = $newParameters;
        return $this;
    }
    
    /**
     * Get class properties
     * 
     * @param string $type
     * @return array
     */
    public function getClassProperties($type)
    {
        if (array_key_exists($type, $this->classProperties)) {
            return $this->classProperties[$type];
        }
        $classProperties = [];
        foreach ($this->getProperties($type) as $property) {
            $propertyType = $property['type'];
            if ($property['type'] == 'object') {
                $propertyType = '\\'.$this->castTypeName($property['value']);
            } else if ($property['type'] == 'copy') {
                $propertyType = null;
            }
            $classProperty = [
                'name' => $property['name'],
                'visibility' => ($property['scope']) ?: 'protected',
                'docblock' => [
                    'tags' => [ [ 'name' => 'var', 'description' => $propertyType ] ]
                ]
            ];
            $classProperties[] = $classProperty;
        }
        $this->classProperties[$type] = $classProperties;
        return $this->classProperties[$type];
    }
    
}