<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\VendorSales\Observer\Framework\Model\AbstractModel;

/**
 * Model before delete observer
 */
class BeforeDelete extends \Ecombricks\Vendor\Observer\Framework\Model\AbstractModel\BeforeDelete\Vendor
{
    
    /**
     * Vendor resource
     * 
     * @var \Ecombricks\Vendor\Model\ResourceModel\Vendor 
     */
    protected $vendorResource;
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Vendor\Model\ResourceModel\Vendor $vendorResource
     * @param array $targetedTypes
     * @return void
     */
    public function __construct(
        \Ecombricks\Vendor\Model\ResourceModel\Vendor $vendorResource,
        $targetedTypes = [
            'order' => \Magento\Sales\Model\Order::class,
            'creditmemo' => \Magento\Sales\Model\Order\Creditmemo::class,
            'invoice' => \Magento\Sales\Model\Order\Invoice::class,
            'shipment' => \Magento\Sales\Model\Order\Shipment::class,
            'paymentTransaction' => \Magento\Sales\Model\Order\Payment\Transaction::class
        ]
    )
    {
        $this->vendorResource = $vendorResource;
        parent::__construct($targetedTypes);
    }
    
    /**
     * Execute
     * 
     * @param \Magento\Framework\Event\Observer $observer
     * @return $this
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        parent::execute($observer);
        $object = $this->getObject($observer);
        if (!$object) {
            return $this;
        }
        if (!$this->isTargetedType($object, [\Ecombricks\Vendor\Model\Vendor::class])) {
            return $this;
        }
        $this->vendorResource->deleteRelatedEntities($object, 'ecombricks_vendor_sales_order');
        $this->vendorResource->deleteRelatedEntities($object, 'sales_order_grid');
        $this->vendorResource->deleteRelatedEntities($object, 'ecombricks_vendor_sales_shipment');
        $this->vendorResource->deleteRelatedEntities($object, 'sales_shipment_grid');
        $this->vendorResource->deleteRelatedEntities($object, 'ecombricks_vendor_sales_invoice');
        $this->vendorResource->deleteRelatedEntities($object, 'sales_invoice_grid');
        $this->vendorResource->deleteRelatedEntities($object, 'ecombricks_vendor_sales_creditmemo');
        $this->vendorResource->deleteRelatedEntities($object, 'sales_creditmemo_grid');
        $this->vendorResource->deleteRelatedEntities($object, 'ecombricks_vendor_sales_payment_transaction');
        return $this;
    }

}