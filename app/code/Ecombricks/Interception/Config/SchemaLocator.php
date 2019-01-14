<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Interception\Config;

/**
 * Interception configuration schema locator
 */
class SchemaLocator implements \Magento\Framework\Config\SchemaLocatorInterface
{
    
    /**
     * URN resolver
     * 
     * @var 
     */
    protected $urnResolver;
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Config\Dom\UrnResolver $urnResolver
     * @return void
     */
    public function __construct(\Magento\Framework\Config\Dom\UrnResolver $urnResolver)
    {
        $this->urnResolver = $urnResolver;
    }
    
    /**
     * Get schema
     *
     * @return string
     */
    public function getSchema()
    {
        return $this->urnResolver->getRealPath('urn:ecombricks:module:Ecombricks_Interception:etc/interception.xsd');
    }
    
    /**
     * Get per file schema
     * 
     * @return string
     */
    public function getPerFileSchema()
    {
        return null;
    }
    
}