<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Framework\Model\ResourceModel\Db\Collection;

/**
 * Abstract collection
 */
abstract class AbstractCollection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    
    /**
     * Get loaded ids
     * 
     * @return array
     */
    protected function getLoadedIds()
    {
        $ids = [];
        foreach ($this->getItems() as $item) {
            $ids[] = $item->getId();
        }
        return $ids;
    }
    
}