<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorQuote\Model\ResourceModel\Quote;

/**
 * Quote resource model vendor trait
 */
trait VendorTrait
{
    
    /**
     * Load by customer
     *
     * @param \Magento\Quote\Model\Quote $quote
     * @param int $vendorId
     * @param int $customerId
     * @return $this
     */
    public function vendorLoadByCustomer($quote, $vendorId, $customerId)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from(['main_table' => $this->getMainTable()])
            ->join(
                ['vendor_table' => $this->getTable('ecombricks_vendor_quote')],
                'main_table.entity_id = vendor_table.entity_id',
                ['vendor_id']
            )
            ->where('main_table.customer_id = ?', $customerId)
            ->where('vendor_table.vendor_id = ?', $vendorId)
            ->where('main_table.is_active = ?', 1)
            ->order('updated_at '.\Magento\Framework\DB\Select::SQL_DESC)
            ->limit(1);
        $storeIds = $quote->getSharedStoreIds();
        if ($storeIds) {
            if ($storeIds != ['*']) {
                $select->where('main_table.store_id IN (?)', $storeIds);
            }
        } else {
            $select->where('main_table.store_id < ?', 0);
        }
        $data = $connection->fetchRow($select);
        if ($data) {
            $quote->setData($data);
        }
        $this->_afterLoad($quote);
        return $this;
    }
    
    /**
     * Get vendor IDs by customer
     * 
     * @param \Magento\Quote\Model\Quote $quote
     * @param int $customerId
     * @return array
     */
    public function getVendorIdsByCustomerId($quote, $customerId)
    {
        $connection = $this->getConnection();
        $quoteIdSelect = $connection->select()
            ->from(['entity_id_table' => $this->getMainTable()], [ 'entity_id' ])
            ->join(
                ['entity_id_vendor_table' => $this->getTable('ecombricks_vendor_quote')],
                'entity_id_table.entity_id = entity_id_vendor_table.entity_id',
                []
            )
            ->where('entity_id_table.customer_id = ?', $customerId)
            ->where('entity_id_vendor_table.vendor_id = vendor_table.vendor_id')
            ->where('entity_id_table.is_active = ?', 1)
            ->where('entity_id_table.items_count > ?', 0)
            ->order('entity_id_table.updated_at '.\Magento\Framework\DB\Select::SQL_DESC)
            ->limit(1);
        $storeIds = $quote->getSharedStoreIds();
        if ($storeIds) {
            if ($storeIds != ['*']) {
                $quoteIdSelect->where('entity_id_table.store_id IN (?)', $storeIds);
            }
        } else {
            $quoteIdSelect->where('entity_id_table.store_id < ?', 0);
        }
        $select = $connection->select()
            ->from(['main_table' => $this->getMainTable()], [])
            ->join(
                ['vendor_table' => $this->getTable('ecombricks_vendor_quote')],
                'main_table.entity_id = vendor_table.entity_id',
                [ 'vendor_id' ]
            )
            ->where('main_table.entity_id = ?', $quoteIdSelect);
        return $connection->fetchCol($select);
    }
    
    /**
     * Get vendor ID by ID
     * 
     * @param int $id
     * @return int
     */
    public function getVendorIdById($id)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from(['vendor_table' => $this->getTable('ecombricks_vendor_quote')], [ 'vendor_id' ])
            ->where('vendor_table.entity_id = ?', $id);
        return $connection->fetchOne($select);
    }
    
}