<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\VendorSales\Controller\AbstractController\Creditmemo;

/**
 * Creditmemo abstract controller vendor trait
 */
trait VendorTrait
{
    
    /**
     * Get creditmemo
     * 
     * @param string|int $creditmemoId
     * @return \Magento\Sales\Api\Data\CreditmemoInterface|null
     */
    public function vendorGetCreditmemo($creditmemoId)
    {
        if (empty($creditmemoId)) {
            return null;
        }
        try {
            $creditmemo = $this->vendorCreditmemoRepository->get($creditmemoId);
        } catch (\Exception $exception) {
            return null;
        }
        return $creditmemo;
    }
    
    /**
     * Before dispatch
     * 
     * @param \Magento\Framework\App\RequestInterface $request
     * @return $this
     */
    public function vendorBeforeDispatch(\Magento\Framework\App\RequestInterface $request)
    {
        $creditmemoId = $request->getParam('creditmemo_id');
        $creditmemo = $this->vendorGetCreditmemo($creditmemoId);
        if (!empty($creditmemo)) {
            $this->setVendorId($creditmemo->getVendorId());
        }
        $this->vendorAfterBeforeDispatch($request);
        return $this;
    }
    
}