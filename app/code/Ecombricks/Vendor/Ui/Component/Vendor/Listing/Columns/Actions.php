<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\Component\Vendor\Listing\Columns;

/**
 * Vendor listing actions column
 */
class Actions extends \Magento\Ui\Component\Listing\Columns\Column
{
    
    /**
     * URL path
     */
    const URL_PATH_EDIT = 'vendor/vendor/edit';
    const URL_PATH_DELETE = 'vendor/vendor/delete';
    
    /**
     * URL builder
     * 
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    
    /**
     * Constructor
     *
     * @param \Magento\Framework\View\Element\UiComponent\ContextInterface $context
     * @param \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\View\Element\UiComponent\ContextInterface $context,
        \Magento\Framework\View\Element\UiComponentFactory $uiComponentFactory,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    )
    {
        $this->urlBuilder = $urlBuilder;
        parent::__construct(
            $context,
            $uiComponentFactory,
            $components,
            $data
        );
    }

    /**
     * Prepare data source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (!isset($dataSource['data']['items'])) {
            return $dataSource;
        }
        foreach ($dataSource['data']['items'] as &$item) {
            if (!isset($item['vendor_id'])) {
                continue;
            }
            $vendorId = (int) $item['vendor_id'];
            $itemName = $this->getData('name');
            $item[$itemName] = [
                'edit' => [
                    'href' => $this->urlBuilder->getUrl(static::URL_PATH_EDIT, ['vendor_id' => $vendorId]),
                    'label' => __('Edit')
                ]
            ];
            if ($vendorId == \Ecombricks\Vendor\Model\Vendor::DEFAULT_ID) {
                continue;
            }
            $item[$itemName]['delete'] = [
                'href' => $this->urlBuilder->getUrl(static::URL_PATH_DELETE, ['vendor_id' => $vendorId]),
                'label' => __('Delete'),
                'confirm' => [
                    'title' => __('Delete "${ $.$data.name }"'),
                    'message' => __('Are you sure you wan\'t to delete a "${ $.$data.name }" vendor?')
                ]
            ];
        }
        return $dataSource;
    }
    
}