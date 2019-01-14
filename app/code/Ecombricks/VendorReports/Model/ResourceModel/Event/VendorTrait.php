<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorReports\Model\ResourceModel\Event;

/**
 * Report event resource model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Apply log to collection
     * 
     * @param \Magento\Framework\Data\Collection\AbstractDb $collection
     * @param int $eventTypeId
     * @param int $eventSubjectId
     * @param int $subtype
     * @param array $skipIds
     * @return $this
     */
    public function vendorApplyLogToCollection(
        \Magento\Framework\Data\Collection\AbstractDb $collection,
        $eventTypeId,
        $eventSubjectId,
        $subtype,
        $skipIds = []
    )
    {
        $idFieldName = $collection->getResource()->getIdFieldName();
        $derivedSelect = $this->getConnection()
            ->select()
            ->from(
                $this->getTable('report_event'),
                ['event_id' => new \Zend_Db_Expr('MAX(event_id)'), 'object_id']
            )
            ->where('event_type_id = ?', (int) $eventTypeId)
            ->where('subject_id = ?', (int) $eventSubjectId)
            ->where('subtype = ?', (int) $subtype)
            ->where('store_id IN(?)', $this->getCurrentStoreIds())
            ->group('object_id');
        if ($skipIds) {
            if (!is_array($skipIds)) {
                $skipIds = [(int) $skipIds];
            }
            $derivedSelect->where('object_id NOT IN(?)', $skipIds);
        }
        $mainTableAlias = ($collection instanceof \Magento\Eav\Model\Entity\Collection\AbstractCollection) ? 'e' : 'main_table';
        $collection->getSelect()->joinInner(
            ['evt' => new \Zend_Db_Expr("({$derivedSelect})")],
            "{$mainTableAlias}.{$idFieldName} = evt.object_id",
            []
        )->order('evt.event_id ' . \Magento\Framework\DB\Select::SQL_DESC);
        return $this;
    }
    
}