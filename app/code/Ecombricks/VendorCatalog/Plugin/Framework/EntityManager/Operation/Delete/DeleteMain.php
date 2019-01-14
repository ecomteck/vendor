<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Framework\EntityManager\Operation\Delete;

/**
 * Delete main entity manager operation plugin
 */
class DeleteMain
{
    
    /**
     * Around execute
     * 
     * @param \Magento\Framework\EntityManager\Operation\Delete\DeleteMain $subject
     * @param \Closure $proceed
     * @param object $entity
     * @param array $arguments
     * @return object
     */
    public function aroundExecute(
        \Magento\Framework\EntityManager\Operation\Delete\DeleteMain $subject,
        \Closure $proceed,
        $entity,
        $arguments = []
    )
    {
        if ($entity instanceof \Magento\Catalog\Model\Product) {
            $entity->vendorBeforeDelete();
        }
        return $proceed($entity, $arguments);
    }
    
}