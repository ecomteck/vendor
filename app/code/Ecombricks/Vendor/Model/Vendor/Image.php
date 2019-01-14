<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace Ecombricks\Vendor\Model\Vendor;

/**
 * Vendor image
 */
class Image
{
    
    /**
     * Width
     */
    const WIDTH = 300;
    
    /**
     * Height
     */
    const HEIGHT = 300;
    
    /**
     * Allowed extensions
     *
     * @var array
     */
    protected $allowedExtensions = ['jpg', 'jpeg', 'gif', 'png'];
    
    /**
     * Media directory
     *
     * @var \Magento\Framework\Filesystem\Directory\WriteInterface
     */
    protected $mediaDirectory;
    
    /**
     * Asset repository
     * 
     * @var \Magento\Framework\View\Asset\Repository 
     */
    protected $assetRepository;
    
    /**
     * Store manager
     * 
     * @var \Magento\Store\Model\StoreManagerInterface 
     */
    protected $storeManager;
    
    /**
     * Image factory
     * 
     * @var \Magento\Framework\Image\Factory
     */
    protected $imageFactory;
    
    /**
     * Uploader
     *
     * @var \Ecombricks\Vendor\Model\Vendor\Image\Uploader
     */
    protected $uploader;
    
    /**
     * Key
     * 
     * @var string
     */
    protected $key;
    
    /**
     * Color
     * 
     * @var array
     */
    protected $color;
    
    /**
     * Dimentions
     * 
     * @var array
     */
    protected $dimentions;
    
    /**
     * Constructor
     *
     * @param \Magento\Framework\Filesystem $filesystem
     * @param \Magento\Framework\View\Asset\Repository $assetRepository
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param \Magento\Framework\Image\Factory $imageFactory
     * @param \Ecombricks\Vendor\Model\Vendor\Image\Uploader $uploader
     * @param string $key
     * @param array $color
     * @param array $dimentions
     * @return void
     */
    public function __construct(
        \Magento\Framework\Filesystem $filesystem,
        \Magento\Framework\View\Asset\Repository $assetRepository,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Magento\Framework\Image\Factory $imageFactory,
        \Ecombricks\Vendor\Model\Vendor\Image\Uploader\Proxy $uploader,
        $key = 'image',
        array $color = ['red' => 255, 'green' => 255, 'blue' => 255],
        array $dimentions = ['width' => self::WIDTH, 'height' => self::HEIGHT]
    )
    {
        $this->mediaDirectory = $filesystem->getDirectoryWrite(\Magento\Framework\App\Filesystem\DirectoryList::MEDIA);
        $this->assetRepository = $assetRepository;
        $this->storeManager = $storeManager;
        $this->imageFactory = $imageFactory;
        $this->uploader = $uploader;
        $this->key = $key;
        $this->color = $color;
        $this->dimentions = $dimentions;
    }
    
    /**
     * Get allowed extensions
     * 
     * @return array
     */
    public function getAllowedExtensions()
    {
        return $this->allowedExtensions;
    }
    
    /**
     * Get file
     * 
     * @param string $path
     * @return string
     */
    protected function getFile($path)
    {
        return basename($path);
    }
    
    /**
     * Get temporary directory path
     * 
     * @return string
     */
    protected function getTmpDirPath()
    {
        return $this->mediaDirectory->getAbsolutePath('vendor/tmp_'.$this->key);
    }
    
    /**
     * Get directory path
     * 
     * @return string
     */
    protected function getDirPath()
    {
        return $this->mediaDirectory->getAbsolutePath('vendor/'.$this->key);
    }
    
    /**
     * Delete path
     * 
     * @param string $path
     * @return bool
     */
    protected function deletePath($path)
    {
        return $this->mediaDirectory->delete($this->getPathRelativePath($path));
    }
    
    /**
     * Get path relative path
     * 
     * @return string
     */
    protected function getPathRelativePath($path)
    {
        return $this->mediaDirectory->getRelativePath($path);
    }
    
    /**
     * Get path
     * 
     * @param string $file
     * @return string
     */
    public function getPath($file)
    {
        return $this->mediaDirectory->getAbsolutePath('vendor/'.$this->key.'/'.$file);
    }
    
    /**
     * Delete file
     * 
     * @param string $file
     * @return bool
     */
    public function deleteFile($file)
    {
        return $this->deletePath($this->getPath($file));
    }
    
    /**
     * Check if exists
     * 
     * @param string $file
     * @return bool
     */
    public function isExists($file)
    {
        return file_exists($this->getPath($file));
    }
    
    /**
     * Get width
     * 
     * @param string $file
     * @return int
     */
    public function getWidth($file)
    {
        if (!$this->isExists($file)) {
            return 0;
        }
        $size = getimagesize($this->getPath($file));
        return isset($size[0]) ? (int) $size[0] : 0;
    }
    
    /**
     * Get height
     * 
     * @param string $file
     * @return int
     */
    public function getHeight($file)
    {
        if (!$this->isExists($file)) {
            return 0;
        }
        $size = getimagesize($this->getPath($file));
        return isset($size[1]) ? (int) $size[1] : 0;
    }
    
    /**
     * Get size
     * 
     * @param string $file
     * @return int
     */
    public function getSize($file)
    {
        return ($this->isExists($file)) ? filesize($this->getPath($file)) : 0;
    }
    
    /**
     * Get default URL
     * 
     * @return string
     */
    public function getDefaultUrl()
    {
        return $this->assetRepository->getUrl('Ecombricks_Vendor::images/vendor/default_'.$this->key.'.png');
    }
    
    /**
     * Get URL
     * 
     * @param string $file
     * @return string
     */
    public function getUrl($file)
    {
        return $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA).'vendor/'.$this->key.'/'.$file;
    }
    
    /**
     * Get information
     * 
     * @param string $file
     * @return array
     */
    public function getInfo($file)
    {
        return [
            'previewType' => 'image',
            'previewWidth' => $this->getWidth($file),
            'previewHeight' => $this->getHeight($file),
            'type' => 'image',
            'size' => $this->getSize($file),
            'name' => $file,
            'url' => $this->getUrl($file)
        ];
    }
    
    /**
     * Create
     * 
     * @param string $tmpFilePath
     * @return string
     */
    protected function create($tmpFilePath)
    {
        $image = $this->imageFactory->create($tmpFilePath);
        $image->keepTransparency(true);
        $image->constrainOnly(true);
        $image->keepFrame(true);
        $image->keepAspectRatio(true);
        $image->backgroundColor([$this->color['red'], $this->color['green'], $this->color['blue']]);
        $image->resize($this->dimentions['width'], $this->dimentions['height']);
        $dirPath = $this->getDirPath();
        $filePath = \Magento\Framework\File\Uploader::getNewFileName($dirPath.'/'.$this->getFile($tmpFilePath));
        $file = $this->getFile($filePath);
        $image->save($dirPath, $file);
        return $file;
    }
    
    /**
     * Upload
     * 
     * @return string|null
     */
    public function upload()
    {
        $tmpFilePath = $this->uploader->upload($this->key.'_file', $this->getTmpDirPath(), $this->getAllowedExtensions());
        if (empty($tmpFilePath)) {
            return null;
        }
        $file = $this->create($tmpFilePath);
        $this->deletePath($tmpFilePath);
        return $file;
    }
    
}