<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\Vendor\Image;

/**
 * Vendor image uploader
 */
class Uploader
{
    
    /**
     * Transfer adapter
     * 
     * @var \Zend_File_Transfer_Adapter_Http
     */
    protected $transferAdapter;
    
    /**
     * Uploader factory
     * 
     * @var \Magento\MediaStorage\Model\File\UploaderFactory
     */
    protected $uploaderFactory;
    
    /**
     * Constructor
     *
     * @param \Magento\Framework\HTTP\Adapter\FileTransferFactory $transferAdapterFactory
     * @param \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
     * @return void
     */
    public function __construct(
        \Magento\Framework\HTTP\Adapter\FileTransferFactory $transferAdapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory
    )
    {
        $this->transferAdapter = $transferAdapterFactory->create();
        $this->uploaderFactory = $uploaderFactory;
    }
    
    /**
     * Upload
     * 
     * @param string $key
     * @param string $path
     * @param string $allowedExtensions
     * @return string
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function upload($key, $path, $allowedExtensions)
    {
        if (!$this->transferAdapter->isUploaded($key)) {
            return false;
        }
        if (!$this->transferAdapter->isValid($key)) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Uploaded image is not valid'));
        }
        $uploader = $this->uploaderFactory->create(['fileId' => $key]);
        $uploader->setAllowCreateFolders(true);
        $uploader->setAllowedExtensions($allowedExtensions);
        $uploader->setAllowRenameFiles(true);
        $uploader->setFilesDispersion(false);
        if (!$uploader->checkAllowedExtension($uploader->getFileExtension())) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Invalid image file type.'));
        }
        $result = $uploader->save($path);
        if (!$result) {
            throw new \Magento\Framework\Exception\LocalizedException(__('Image can not be saved.'));
        }
        return $path.'/'.$uploader->getUploadedFileName();
    }
    
}