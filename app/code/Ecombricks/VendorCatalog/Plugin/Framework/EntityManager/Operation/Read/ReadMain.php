<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorCatalog\Plugin\Framework\EntityManager\Operation\Read;

/**
 * Read main entity manager operation plugin
 */
class ReadMain
{
    
    /**
     * Around execute
     * 
     * @param \Magento\Framework\EntityManager\Operation\Read\ReadMain $subject
     * @param \Closure $proceed
     * @param object $entity
     * @param string $identifier
     * @return object
     */
    public function aroundExecute(
        \Magento\Framework\EntityManager\Operation\Read\ReadMain $subject,
        \Closure $proceed,
        $entity, 
        $identifier
    )
    {
        $result = $proceed($entity, $identifier);
        if ($result instanceof \Magento\Catalog\Model\Product) {
            $result->vendorAfterLoad();
        }
        return $result;
    }
    
}