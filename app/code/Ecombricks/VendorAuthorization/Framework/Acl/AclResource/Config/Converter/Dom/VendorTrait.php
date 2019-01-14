<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorAuthorization\Framework\Acl\AclResource\Config\Converter\Dom;

/**
 * Acl config converter vendor trait
 */
trait VendorTrait
{
    
    /**
     * Convert
     * 
     * @param \DOMDocument $source
     * @return array
     */
    public function vendorConvert($source)
    {
        $aclResourceConfig = ['config' => ['acl' => ['resources' => []]]];
        $xpath = new \DOMXPath($source);
        foreach ($xpath->query('/config/acl/resources/resource') as $resourceNode) {
            $aclResourceConfig['config']['acl']['resources'][] = $this->vendorConvertResourceNode($resourceNode);
        }
        return $aclResourceConfig;
    }
    
    /**
     * Convert resource node
     * 
     * @param \DOMNode $resourceNode
     * @return array
     * @throws \Exception
     */
    protected function vendorConvertResourceNode(\DOMNode $resourceNode)
    {
        $resourceData = [];
        $resourceAttributes = $resourceNode->attributes;
        $idNode = $resourceAttributes->getNamedItem('id');
        if ($idNode === null) {
            throw new \Exception('Attribute "id" is required for ACL resource.');
        }
        $resourceData['id'] = $idNode->nodeValue;
        $moduleNode = $resourceAttributes->getNamedItem('module');
        if ($moduleNode !== null) {
            $resourceData['module'] = $moduleNode->nodeValue;
        }
        $titleNode = $resourceAttributes->getNamedItem('title');
        if ($titleNode !== null) {
            $resourceData['title'] = $titleNode->nodeValue;
        }
        $sortOrderNode = $resourceAttributes->getNamedItem('sortOrder');
        $resourceData['sortOrder'] = $sortOrderNode !== null ? (int)$sortOrderNode->nodeValue : 0;
        $disabledNode = $resourceAttributes->getNamedItem('disabled');
        $resourceData['disabled'] = $disabledNode !== null && $disabledNode->nodeValue == 'true' ? true : false;
        $enabledForVendorNode = $resourceAttributes->getNamedItem('enabledForVendor');
        $resourceData['enabledForVendor'] = $enabledForVendorNode !== null && $enabledForVendorNode->nodeValue == 'true' ? true : false;
        $resourceData['children'] = [];
        foreach ($resourceNode->childNodes as $childNode) {
            if ($childNode->nodeName == 'resource') {
                $resourceData['children'][] = $this->vendorConvertResourceNode($childNode);
            }
        }
        return $resourceData;
    }
    
}