<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Framework\EntityManager\Operation\Create;

/**
 * Create main entity manager operation plugin
 */
class CreateMain
{
    
    /**
     * Around execute
     * 
     * @param \Magento\Framework\EntityManager\Operation\Create\CreateMain $subject
     * @param \Closure $proceed
     * @param object $entity
     * @param array $arguments
     * @return object
     */
    public function aroundExecute(
        \Magento\Framework\EntityManager\Operation\Create\CreateMain $subject,
        \Closure $proceed,
        $entity,
        $arguments = []
    )
    {
        $result = $proceed($entity, $arguments);
        if ($result instanceof \Magento\Catalog\Model\Product) {
            $result->vendorAfterSave();
        }
        return $result;
    }
    
}