<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier;

/**
 * Vendor form data provider general modifier
 */
class General extends \Ecombricks\Vendor\Ui\DataProvider\Vendor\Form\Modifier\AbstractModifier
{
    
    /**
     * URL builder
     * 
     * @var \Magento\Framework\UrlInterface
     */
    protected $urlBuilder;
    
    /**
     * File size
     * 
     * @var \Magento\Framework\File\Size
     */
    protected $fileSize;
    
    /**
     * Logo
     * 
     * @var \Ecombricks\Vendor\Model\Vendor\Logo
     */
    protected $logo;
    
    /**
     * Constructor
     * 
     * @param \Ecombricks\Vendor\Model\Locator\LocatorInterface $locator
     * @param \Magento\Framework\Stdlib\ArrayManager $arrayManager
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param \Magento\Framework\File\Size $fileSize
     * @param \Ecombricks\Vendor\Model\Vendor\Logo $logo
     * @return void
     */
    public function __construct(
        \Ecombricks\Vendor\Model\Locator\LocatorInterface $locator,
        \Magento\Framework\Stdlib\ArrayManager $arrayManager,
        \Magento\Framework\UrlInterface $urlBuilder,
        \Magento\Framework\File\Size $fileSize,
        \Ecombricks\Vendor\Model\Vendor\Logo $logo
    )
    {
        $this->urlBuilder = $urlBuilder;
        $this->fileSize = $fileSize;
        $this->logo = $logo;
        parent::__construct($locator, $arrayManager);
    }
    
    /**
     * Get logo note
     * 
     * @return \Magento\Framework\Phrase
     */
    protected function getLogoNote()
    {
        $maxImageSize = $this->fileSize->getMaxFileSizeInMb();
        if ($maxImageSize) {
            return __('Max image size %1M', $maxImageSize);
        } else {
            return __('Something is wrong with the file upload settings.');
        }
    }
    
    /**
     * Modify assigned data
     * 
     * @return $this
     */
    protected function modifyAssignedData()
    {
        $vendor = $this->getVendor();
        $this
            ->setVendorFieldValue('is_active')
            ->setVendorFieldValue('code')
            ->setVendorFieldValue('name');
        $file = $vendor->getLogo();
        if ($file) {
            $this->setVendorFieldValue('logo_file', [$this->logo->getInfo($file)]);
        }
        return $this;
    }
    
    /**
     * Modify assigned meta
     * 
     * @return $this
     */
    protected function modifyAssignedMeta()
    {
        $fieldsetCode = 'general';
        $allowedExtensions = implode(' ', $this->logo->getAllowedExtensions());
        $children = [
            static::CONTAINER_PREFIX.'is_active' => $this->createFieldContainerMeta(
                'is_active',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Boolean::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Checkbox::NAME,
                    'prefer' => 'toggle',
                    'valueMap' => [ 'true' => '1', 'false' => '0' ],
                    'options' => [
                        [ 'value' => 1, 'label' => __('Enabled') ],
                        [ 'value' => 0, 'label' => __('Disabled') ]
                    ],
                    'required' => false,
                    'label' => __('Enable Vendor'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 10
                ]
            ),
            static::CONTAINER_PREFIX.'code' => $this->createFieldContainerMeta(
                'code',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                    'required' => true,
                    'label' => __('Code'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => true,
                        'min_text_length' => 2,
                        'max_text_length' => 32
                    ],
                    'sortOrder' => 20
                ]
            ),
            static::CONTAINER_PREFIX.'name' => $this->createFieldContainerMeta(
                'name',
                [
                    'dataType' => \Magento\Ui\Component\Form\Element\DataType\Text::NAME,
                    'formElement' => \Magento\Ui\Component\Form\Element\Input::NAME,
                    'required' => true,
                    'label' => __('Name'),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => true,
                        'min_text_length' => 2,
                        'max_text_length' => 64
                    ],
                    'sortOrder' => 30
                ]
            ),
            static::CONTAINER_PREFIX.'logo_file' => $this->createFieldContainerMeta(
                'logo_file',
                [
                    'dataType' => 'fileUploader',
                    'formElement' => 'fileUploader',
                    'maxFileSize' => $this->fileSize->getMaxFileSize(),
                    'allowedExtensions' => $allowedExtensions,
                    'uploaderConfig' => [
                        'url' => $this->urlBuilder->addSessionParam()->getUrl('vendor/vendor/uploadLogo', ['_secure' => true]),
                    ],
                    'isMultipleFiles' => false,
                    'required' => false,
                    'label' => __('Logo'),
                    'notice' => $this->getLogoNote(),
                    'source' => $fieldsetCode,
                    'validation' => [
                        'required-entry' => false
                    ],
                    'sortOrder' => 40
                ]
            )
        ];
        $this->setMeta(
            $this->createFieldsetMeta(
                [
                    'label' => '',
                    'collapsible' => false,
                    'opened' => true,
                    'dataScope' => static::DATA_SCOPE_VENDOR,
                    'sortOrder' => 10
                ],
                $children
            ),
            $fieldsetCode
        );
        return $this;
    }
    
}