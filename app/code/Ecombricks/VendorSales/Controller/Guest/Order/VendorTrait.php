<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\Guest\Order;

/**
 * Guest order controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get order increment ID
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return string|null
     */
    public function vendorGetOrderIncrementId(\Magento\Framework\App\RequestInterface $request)
    {
        $orderIncrementId = $request->getParam('oar_order_id');
        if (!empty($orderIncrementId)) {
            return $orderIncrementId;
        }
        $cookie = $this->vendorCookieManager->getCookie(\Magento\Sales\Helper\Guest::COOKIE_NAME);
        if (empty($cookie)) {
            return null;
        }
        $cookieData = explode(':', base64_decode($cookie));
        if (empty($cookieData[1])) {
            return null;
        }
        return $cookieData[1];
    }
    
    /**
     * Get order
     * 
     * @param string $orderIncrementId
     * @return \Magento\Sales\Api\Data\OrderInterface|null
     */
    public function vendorGetOrder($orderIncrementId)
    {
        if (empty($orderIncrementId)) {
            return null;
        }
        $searchCriteria = $this->vendorSearchCriteriaBuilder->addFilter('increment_id', $orderIncrementId)->create();
        $searchResult = $this->vendorOrderRepository->getList($searchCriteria);
        if ($searchResult->getTotalCount() < 1) {
            return null;
        }
        $orders = $searchResult->getItems();
        return array_shift($orders);
    }
    
    /**
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $orderIncrementId = $this->vendorGetOrderIncrementId($request);
        $order = $this->vendorGetOrder($orderIncrementId);
        if (!empty($order)) {
            $this->setVendorId($order->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}