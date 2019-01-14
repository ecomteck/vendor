<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Ui\App\Response;

/**
 * Response data object factory
 */
class DataObjectFactory
{
    
    /**
     * Object manager
     *
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $objectManager;
    
    /**
     * Instance name
     *
     * @var string
     */
    protected $instanceName;
    
    /**
     * Constructor
     *
     * @param \Magento\Framework\ObjectManagerInterface $objectManager
     * @param string $instanceName
     * @return void
     */
    public function __construct(
        \Magento\Framework\ObjectManagerInterface $objectManager,
        $instanceName = \Ecombricks\Ui\App\Response\DataObject::class
    )
    {
        $this->objectManager = $objectManager;
        $this->instanceName = $instanceName;
    }
    
    /**
     * Create
     * 
     * @param array $data
     * @return \Ecombricks\CatalogChangeRequest\App\Response\DataObject
     */
    public function create(array $data = array())
    {
        return $this->objectManager->create($this->instanceName, $data);
    }
    
}