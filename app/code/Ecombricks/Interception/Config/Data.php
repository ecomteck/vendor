<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Interception\Config;

/**
 * Interception configuration data
 */
class Data extends \Magento\Framework\Config\Data
{
    
    /**
     * Traits
     *
     * @var array
     */
    protected $traits = [];
    
    /**
     * Properties
     *
     * @var array
     */
    protected $properties = [];
    
    /**
     * Reader
     *
     * @var \Magento\Framework\Config\ReaderInterface
     */
    protected $reader;
    
    /**
     * Cache
     *
     * @var \Magento\Framework\Config\CacheInterface
     */
    protected $cache;

    /**
     * Cache ID
     *
     * @var string
     */
    protected $cacheId;
    
    /**
     * Object manager configuration
     *
     * @var \Magento\Framework\Interception\ObjectManager\ConfigInterface
     */
    protected $objectManagerConfig;
    
    /**
     * Object manager relations
     *
     * @var \Magento\Framework\ObjectManager\RelationsInterface
     */
    protected $objectManagerRelations;
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Interception\Config\Reader $reader
     * @param \Magento\Framework\Config\ScopeInterface $configScope
     * @param \Magento\Framework\Config\CacheInterface $cache
     * @param \Magento\Framework\Interception\ObjectManager\ConfigInterface $objectManagerConfig
     * @param \Magento\Framework\ObjectManager\RelationsInterface $objectManagerRelations
     * @param array $scopePriorityScheme
     * @param string $cacheId
     * @return void
     */
    public function __construct(
        \Ecombricks\Interception\Config\Reader $reader,
        \Magento\Framework\Config\CacheInterface $cache,
        \Magento\Framework\Interception\ObjectManager\ConfigInterface $objectManagerConfig,
        \Magento\Framework\ObjectManager\RelationsInterface $objectManagerRelations,
        $cacheId = 'ecombricks_interception'
    )
    {
        $this->reader = $reader;
        $this->cache = $cache;
        $this->cacheId = $cacheId;
        $this->objectManagerConfig = $objectManagerConfig;
        $this->objectManagerRelations = $objectManagerRelations;
        $this->initData();
    }
    
    /**
     * Compare traits
     * 
     * @param array $trait1
     * @param array $trait2
     * @return int
     */
    protected function compareTraits($trait1, $trait2)
    {
        return $trait1['sortOrder'] - $trait2['sortOrder'];
    }
    
    /**
     * Inherit data
     * 
     * @param string $type
     * @return array
     */
    protected function inheritData($type)
    {
        if (
            !array_key_exists($type, $this->traits) || 
            !array_key_exists($type, $this->properties)
        ) {
            $realType = $this->objectManagerConfig->getOriginalInstanceType($type);
            if ($realType !== $type) {
                list($traits, $properties) = $this->inheritData($realType);
            } elseif ($this->objectManagerRelations->has($type)) {
                $parentTypes = $this->objectManagerRelations->getParents($type);
                $traits = [];
                $properties = [];
                if (!empty($parentTypes)) {
                    foreach ($parentTypes as $parentType) {
                        if (empty($parentType)) {
                            continue;
                        }
                        list($parentTraits, $parentProperties) = $this->inheritData($parentType);
                        $traits = array_replace_recursive($traits, $parentTraits);
                        $properties = array_replace_recursive($properties, $parentProperties);
                    }
                }

            } else {
                $traits = [];
                $properties = [];
            }
            if (!empty($this->_data[$type])) {
                if (!empty($this->_data[$type]['traits'])) {
                    $traits = array_replace_recursive($traits, $this->_data[$type]['traits']);
                }
                if (!empty($this->_data[$type]['properties'])) {
                    $properties = array_replace_recursive($properties, $this->_data[$type]['properties']);
                }
            }
            $this->traits[$type] = [];
            $this->properties[$type] = [];
            if (!empty($traits)) {
                uasort($traits, [$this, 'compareTraits']);
                foreach ($traits as $traitType => $trait) {
                    if (!empty($trait['disabled'])) {
                        continue;
                    }
                    $realTraitType = $this->objectManagerConfig->getOriginalInstanceType($traitType);
                    if (!trait_exists($realTraitType)) {
                        throw new \InvalidArgumentException(__('Trait class %1 doesn\'t exist', $realTraitType));
                    }
                    $this->traits[$type][$traitType] = $trait;
                }
            }
            if (!empty($properties)) {
                foreach ($properties as $propertyName => $property) {
                    if (!empty($property['disabled'])) {
                        continue;
                    }
                    $this->properties[$type][$propertyName] = $property;
                }
            }
        }
        return [$this->traits[$type], $this->properties[$type]];
    }
    
    /**
     * Initialize data
     * 
     * @return void
     */
    protected function initData()
    {
        $data = $this->cache->load($this->cacheId);
        if (false === $data) {
            $this->_data = $this->reader->read();
            $this->traits = [];
            $this->properties = [];
            $this->cache->save(serialize([$this->_data, $this->traits, $this->properties]), $this->cacheId);
        } else {
            list($this->_data, $this->traits, $this->properties) = unserialize($data);
        }
    }
    
    /**
     * Get traits
     * 
     * @param string $type
     * @return array
     */
    public function getTraits($type)
    {
        $this->inheritData($type);
        return !empty($this->traits[$type]) ? $this->traits[$type] : [];
    }
    
    /**
     * Get properties
     * 
     * @param string $type
     * @return array
     */
    public function getProperties($type)
    {
        $this->inheritData($type);
        return !empty($this->properties[$type]) ? $this->properties[$type] : [];
    }
    
    /**
     * Get types
     * 
     * @return array
     */
    public function getTypes()
    {
        return array_keys($this->_data);
    }
    
}