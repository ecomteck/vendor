<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorReports\Plugin\Model\ResourceModel;

/**
 * Report event resource model plugin
 */
class Event
{
    
    /**
     * Around apply log to collection
     * 
     * @param \Magento\Reports\Model\ResourceModel\Event $subject
     * @param \Closure $proceed
     * @param \Magento\Framework\Data\Collection\AbstractDb $collection
     * @param int $eventTypeId
     * @param int $eventSubjectId
     * @param int $subtype
     * @param array $skipIds
     * @return \Magento\Reports\Model\ResourceModel\Event
     */
    public function aroundApplyLogToCollection(
        \Magento\Reports\Model\ResourceModel\Event $subject,
        \Closure $proceed,
        \Magento\Framework\Data\Collection\AbstractDb $collection,
        $eventTypeId,
        $eventSubjectId,
        $subtype,
        $skipIds = []
    )
    {
        return $subject->vendorApplyLogToCollection($collection, $eventTypeId, $eventSubjectId, $subtype, $skipIds);
    }
    
}