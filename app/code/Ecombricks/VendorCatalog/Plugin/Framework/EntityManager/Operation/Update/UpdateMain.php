<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Framework\EntityManager\Operation\Update;

/**
 * Update main entity manager operation plugin
 */
class UpdateMain
{
    
    /**
     * Around execute
     * 
     * @param \Magento\Framework\EntityManager\Operation\Update\UpdateMain $subject
     * @param \Closure $proceed
     * @param object $entity
     * @param array $arguments
     * @return object
     */
    public function aroundExecute(
        \Magento\Framework\EntityManager\Operation\Update\UpdateMain $subject,
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