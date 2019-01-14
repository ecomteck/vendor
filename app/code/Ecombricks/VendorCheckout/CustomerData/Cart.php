<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorCheckout\CustomerData;

/**
 * Cart customer data
 */
class Cart implements \Magento\Customer\CustomerData\SectionSourceInterface
{
    
    /**
     * Cart customer data
     * 
     * @var \Magento\Checkout\CustomerData\Cart
     */
    protected $cartCustomerData;
    
    /**
     * Checkout session
     * 
     * @var \Magento\Checkout\Model\Session
     */
    protected $checkoutSession;
    
    /**
     * Vendor management
     * 
     * @var \Ecombricks\Vendor\Model\VendorManagement
     */
    protected $vendorManagement;
    
    /**
     * Constructor
     * 
     * @param \Magento\Checkout\CustomerData\Cart $cartCustomerData
     * @param \Magento\Checkout\Model\Session $checkoutSession
     * @param \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
     * @return void
     */
    public function __construct(
        \Magento\Checkout\CustomerData\Cart $cartCustomerData,
        \Magento\Checkout\Model\Session $checkoutSession,
        \Ecombricks\Vendor\Model\VendorManagement $vendorManagement
    ) {
        $this->cartCustomerData = $cartCustomerData;
        $this->checkoutSession = $checkoutSession;
        $this->vendorManagement = $vendorManagement;
    }
    
    /**
     * Get vendors
     * 
     * @return \Ecombricks\Vendor\Model\Vendor[]
     */
    protected function getVendors()
    {
        return $this->vendorManagement->getVendorsByIds($this->checkoutSession->getVendorIds());
    }
    
    /**
     * Get section data
     * 
     * @return array
     */
    public function getSectionData()
    {
        $summaryCount = 0;
        $isPossibleOnepageCheckout = false;
        $isGuestCheckoutAllowed = false;
        $websiteId = null;
        $extraActions = null;
        $items = [];
        $data = [ 'vendors' => [] ];
        foreach ($this->getVendors() as $vendorId => $vendor) {
            $this->cartCustomerData->setVendorId($vendorId);
            $vendorData = $this->cartCustomerData->getSectionData();
            if (!empty($vendorData['summary_count'])) {
                $summaryCount += $vendorData['summary_count'];
            }
            if (!empty($vendorData['possible_onepage_checkout'])) {
                $isPossibleOnepageCheckout = true;
            }
            if (!empty($vendorData['isGuestCheckoutAllowed'])) {
                $isGuestCheckoutAllowed = true;
            }
            if (!empty($vendorData['website_id']) && ($websiteId === null)) {
                $websiteId = $vendorData['website_id'];
            }
            if (!empty($vendorData['extra_actions']) && ($extraActions === null)) {
                $extraActions = $vendorData['extra_actions'];
            }
            if (!empty($vendorData['items'])) {
                $items = array_merge($items, $vendorData['items']);
            }
            $data['vendors'][] = array_merge([ 'id' => $vendorId, 'name' => $vendor->getName() ], $vendorData);
        }
        $data['summary_count'] = $summaryCount;
        $data['possible_onepage_checkout'] = $isPossibleOnepageCheckout;
        $data['isGuestCheckoutAllowed'] = $isGuestCheckoutAllowed;
        $data['website_id'] = $websiteId;
        $data['extra_actions'] = $extraActions;
        $data['items'] = $items;
        return $data;
    }
    
}