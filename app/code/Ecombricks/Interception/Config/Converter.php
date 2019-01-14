<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Interception\Config;

/**
 * Interception configuration converter
 */
class Converter implements \Magento\Framework\Config\ConverterInterface
{
    
    /**
     * Boolean utilities
     * 
     * @var \Magento\Framework\Stdlib\BooleanUtils
     */
    protected $booleanUtils;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Stdlib\BooleanUtils $booleanUtils
     * @return void
     */
    public function __construct(
        \Magento\Framework\Stdlib\BooleanUtils $booleanUtils
    )
    {
        $this->booleanUtils = $booleanUtils;
    }
    
    /**
     * Get node value
     * 
     * @param \DOMNode $node
     * @return mixed
     */
    protected function getNodeValue($node)
    {
        return ($node) ? trim($node->nodeValue) : null;
    }
    
    /**
     * Get boolean node value
     * 
     * @param \DOMNode $node
     * @return bool
     */
    protected function getBooleanNodeValue($node)
    {
        return ($node) ? $this->booleanUtils->toBoolean(trim($node->nodeValue)) : null;
    }
    
    /**
     * Get array node value
     * 
     * @param \DOMNode $node
     * @return array
     */
    protected function getArrayNodeValue($node)
    {
        $value = [];
        foreach ($node->childNodes as $childNode) {
            if ($childNode->nodeType != XML_ELEMENT_NODE) {
                continue;
            }
            $childNodeName = $childNode->nodeName;
            if ($childNodeName !== 'item') {
                continue;
            }
            $childNodeAttributes = $childNode->attributes;
            $name = $this->getNodeValue($childNodeAttributes->getNamedItem('name'));
            $value[$name] = $this->getNodeValue($childNode);
        }
        return $value;
    }
    
    /**
     * Convert trait node
     * 
     * @param \DOMNode $node
     * @return array
     */
    protected function convertTraitNode($node)
    {
        $nodeAttributes = $node->attributes;
        return [
            'type' => ltrim($this->getNodeValue($nodeAttributes->getNamedItem('type')), '\\'),
            'disabled' => $this->getBooleanNodeValue($nodeAttributes->getNamedItem('disabled')),
            'sortOrder' => (int) $this->getNodeValue($nodeAttributes->getNamedItem('sortOrder'))
        ];
    }
    
    /**
     * Convert property node
     * 
     * @param \DOMNode $node
     * @return array
     */
    protected function convertPropertyNode($node)
    {
        $nodeAttributes = $node->attributes;
        $name = $this->getNodeValue($nodeAttributes->getNamedItem('name'));
        $type = $this->getNodeValue($nodeAttributes->getNamedItem('type'));
        $scope = $this->getNodeValue($nodeAttributes->getNamedItem('scope'));
        $disabled = $this->getBooleanNodeValue($nodeAttributes->getNamedItem('disabled'));
        $value = ($type == 'array') ? $this->getArrayNodeValue($node) : $this->getNodeValue($node);
        return [
            'name' => $name,
            'type' => $type,
            'scope' => $scope,
            'disabled' => $disabled,
            'value' => $value
        ];
    }
    
    /**
     * Convert dom node tree to array
     * 
     * @param \DOMDocument $config
     * @return array
     * @throws \InvalidArgumentException
     */
    public function convert($config)
    {
        $output = [];
        foreach ($config->documentElement->childNodes as $typeNode) {
            if (($typeNode->nodeType != XML_ELEMENT_NODE) || ($typeNode->nodeName != 'type')) {
                continue;
            }
            $name= ltrim($typeNode->attributes->getNamedItem('name')->nodeValue, '\\');
            $type = ['name' => $name];
            foreach ($typeNode->childNodes as $node) {
                if ($node->nodeType != XML_ELEMENT_NODE) {
                    continue;
                }
                if ($node->nodeName == 'trait') {
                    $trait = $this->convertTraitNode($node);
                    $type['traits'][$trait['type']] = $trait;
                } else if ($node->nodeName == 'property') {
                    $property = $this->convertPropertyNode($node);
                    $type['properties'][$property['name']] = $property;
                }
            }
            $output[$name] = $type;
        }
        return $output;
    }
    
}