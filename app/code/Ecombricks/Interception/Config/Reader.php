<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Interception\Config;

/**
 * Interception configuration reader
 */
class Reader extends \Magento\Framework\Config\Reader\Filesystem
{
    
    /**
     * List of id attributes
     * 
     * @var array
     */
    protected $_idAttributes = [
        '/config/type' => 'name',
        '/config/type/trait' => 'type',
        '/config/type/property' => 'name',
        '/config/type/property(/item)+' => 'name'
    ];
    
    /**
     * Constructor
     * 
     * @param \Magento\Framework\Config\FileResolverInterface $fileResolver
     * @param \Ecombricks\Interception\Config\Converter $converter
     * @param \Ecombricks\Interception\Config\SchemaLocator $schemaLocator
     * @param \Magento\Framework\Config\ValidationStateInterface $validationState
     * @param string $fileName
     * @param array $idAttributes
     * @param string $domDocumentClass
     * @param string $defaultScope
     * @return void
     */
    public function __construct(
        \Magento\Framework\Config\FileResolverInterface $fileResolver,
        \Ecombricks\Interception\Config\Converter $converter,
        \Ecombricks\Interception\Config\SchemaLocator $schemaLocator,
        \Magento\Framework\Config\ValidationStateInterface $validationState,
        $fileName = 'interception.xml',
        $idAttributes = [],
        $domDocumentClass = \Magento\Framework\Config\Dom::class,
        $defaultScope = 'global'
    )
    {
        parent::__construct(
            $fileResolver,
            $converter,
            $schemaLocator,
            $validationState,
            $fileName,
            $idAttributes,
            $domDocumentClass,
            $defaultScope
        );
    }
    
}