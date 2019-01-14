<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Ui\DataProvider\Modifier;

/**
 * Data provider modifier trait
 */
trait ModifierTrait
{
    
    /**
     * Array manager
     * 
     * @var \Magento\Framework\Stdlib\ArrayManager
     */
    protected $arrayManager;
    
    /**
     * Data
     * 
     * @var array
     */
    protected $data = [];
    
    /**
     * Meta
     * 
     * @var array
     */
    protected $meta = [];
    
    /**
     * Check if has data
     * 
     * @param string $path
     * @return bool
     */
    protected function hasData($path)
    {
        return $this->arrayManager->exists($path, $this->data);
    }
    
    /**
     * Get data
     * 
     * @param string|null $path
     * @return mixed
     */
    protected function getData($path = null)
    {
        if ($path === null) {
            return $this->data;
        }
        return $this->arrayManager->get($path, $this->data);
    }
    
    /**
     * Set data
     * 
     * @param array $data
     * @param string|null $path
     * @return $this
     */
    protected function setData($data, $path = null)
    {
        if ($path === null) {
            $this->data = $data;
        }
        $this->data = $this->arrayManager->set($path, $this->data, $data);
        return $this;
    }
    
    /**
     * Remove data
     * 
     * @param string $path
     * @return $this
     */
    protected function removeData($path)
    {
        $this->data = $this->arrayManager->remove($path, $this->data);
        return $this;
    }
    
    /**
     * Modify assigned data
     * 
     * @return $this
     */
    protected function modifyAssignedData()
    {
        return $this;
    }
    
    /**
     * Modify data
     * 
     * @param array $data
     * @return array
     */
    public function modifyData(array $data)
    {
        $this->setData($data);
        $this->modifyAssignedData();
        return $this->getData();
    }
    
    /**
     * Check if has meta
     * 
     * @param string $path
     * @return bool
     */
    protected function hasMeta($path)
    {
        return $this->arrayManager->exists($path, $this->meta);
    }
    
    /**
     * Get meta
     * 
     * @param string|null $path
     * @return mixed
     */
    protected function getMeta($path = null)
    {
        if ($path === null) {
            return $this->meta;
        }
        return $this->arrayManager->get($path, $this->meta);
    }
    
    /**
     * Set meta
     * 
     * 
     * @param array $meta
     * @param string|null $path
     * @return $this
     */
    protected function setMeta($meta, $path = null)
    {
        if ($path === null) {
            $this->meta = $meta;
        }
        $this->meta = $this->arrayManager->set($path, $this->meta, $meta);
        return $this;
    }
    
    /**
     * Merge meta
     * 
     * @param array $meta
     * @param string $path
     * @return $this
     */
    protected function mergeMeta($meta, $path)
    {
        $this->meta = $this->arrayManager->merge($path, $this->meta, $meta);
        return $this;
    }
    
    /**
     * Replace meta
     * 
     * @param mixed $value
     * @param string $path
     * @return $this
     */
    protected function replaceMeta($value, $path)
    {
        $this->meta = $this->arrayManager->replace($path, $this->meta, $value);
        return $this;
    }
    
    /**
     * Remove meta
     * 
     * @param string $path
     * @return $this
     */
    protected function removeMeta($path)
    {
        $this->meta = $this->arrayManager->remove($path, $this->meta);
        return $this;
    }
    
    /**
     * Find meta path
     * 
     * @param string $index
     * @param string|array|null $startPath
     * @param string|array|null $internalPath
     * @return array
     */
    protected function findMetaPath($index, $startPath = null, $internalPath = null)
    {
        return $this->arrayManager->findPath($index, $this->meta, $startPath, $internalPath);
    }
    
    /**
     * Find meta paths
     * 
     * @param string $index
     * @param string|array|null $startPath
     * @param string|array|null $internalPath
     * @return array
     */
    protected function findMetaPaths($index, $startPath = null, $internalPath = null)
    {
        return $this->arrayManager->findPaths($index, $this->meta, $startPath, $internalPath);
    }
    
    /**
     * Replace meta value
     * 
     * @param string $index
     * @param string $search
     * @param string $replace
     * @param string|array|null $startPath
     * @param string|array|null $internalPath
     * @return $this
     */
    protected function replaceMetaValue($index, $search, $replace, $startPath = null, $internalPath = null)
    {
        foreach ($this->findMetaPaths($index, $startPath, $internalPath) as $path) {
            $value = $this->getMeta($path);
            if (!$value || !is_string($value) || strpos($value, $search) === false) {
                continue;
            }
            $this->setMeta(str_replace($search, $replace, $value), $path);
        }
        return $this;
    }
    
    /**
     * Create component meta
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createComponentMeta($config = [], $children = [])
    {
        return [
            'arguments' => [ 'data' => [ 'config' => $config ] ],
            'children' => $children
        ];
    }
    
    /**
     * Update component meta
     * 
     * @param string $path
     * @param array $config
     * @param array $children
     * @return $this
     */
    protected function updateComponentMeta($path, $config = [], $children = [])
    {
        if (!empty($config)) {
            $this->mergeMeta($config, $path.'/arguments/data/config');
        }
        if (!empty($children)) {
            $this->mergeMeta($children, $path.'/children');
        }
        return $this;
    }
    
    /**
     * Create fieldset
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createFieldsetMeta($config = [], $children = [])
    {
        return $this->createComponentMeta(array_merge([
            'componentType' => \Magento\Ui\Component\Form\Fieldset::NAME,
            'label' => '',
            'collapsible' => true,
            'opened' => false,
            'visible' => true,
            'sortOrder' => 0
        ], $config), $children);
    }
    
    /**
     * Create container meta
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createContainerMeta($config = [], $children = [])
    {
        return $this->createComponentMeta(array_merge([
            'componentType' => 'container',
            'formElement' => 'container',
            'breakLine' => 'false'
        ], $config), $children);
    }
    
    /**
     * Create field meta
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createFieldMeta($config = [], $children = [])
    {
        return $this->createComponentMeta(array_merge([ 
            'componentType' => \Magento\Ui\Component\Form\Field::NAME 
        ], $config), $children);
    }
    
    /**
     * Create hidden field meta
     * 
     * @param array $config
     * @return array
     */
    protected function createHiddenFieldMeta($config = [])
    {
        return $this->createFieldMeta(array_merge([ 
            'formElement' => \Magento\Ui\Component\Form\Element\Hidden::NAME 
        ], $config));
    }
    
    /**
     * Create insert listing meta
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createInsertListingMeta($config = [], $children = [])
    {
        return $this->createComponentMeta(array_merge([ 
            'componentType' => 'insertListing'
        ], $config), $children);
    }
    
    /**
     * Create insert form meta
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createInsertFormMeta($config = [], $children = [])
    {
        return $this->createComponentMeta(array_merge([
            'componentType' => 'insertForm'
        ], $config), $children);
    }
    
    /**
     * Create modal meta
     * 
     * @param array $config
     * @param array $children
     * @return array
     */
    protected function createModalMeta($config = [], $children = [])
    {
        return $this->createComponentMeta(array_merge([ 
            'componentType' => \Magento\Ui\Component\Modal::NAME,
            'isTemplate' => false
        ], $config), $children);
    }
    
    /**
     * Create field container meta
     * 
     * @param string $fieldName
     * @param array $fieldConfig
     * @param array $containerConfig
     * @return array
     */
    protected function createFieldContainerMeta($fieldName, $fieldConfig = [], $containerConfig = [])
    {
        $fieldConfig = array_merge([
            'code' => $fieldName,
            'visible' => true,
            'notice' => null,
            'default' => null
        ], $fieldConfig);
        $containerConfig = array_merge([ 'breakLine' => false ], $containerConfig);
        if (array_key_exists('label', $fieldConfig) && !array_key_exists('label', $containerConfig)) {
            $containerConfig['label'] = $fieldConfig['label'];
        }
        if (array_key_exists('required', $fieldConfig) && !array_key_exists('required', $containerConfig)) {
            $containerConfig['required'] = $fieldConfig['required'];
        }
        if (array_key_exists('sortOrder', $fieldConfig) && !array_key_exists('sortOrder', $containerConfig)) {
            $containerConfig['sortOrder'] = $fieldConfig['sortOrder'];
        }
        return $this->createContainerMeta($containerConfig, [ $fieldName => $this->createFieldMeta($fieldConfig) ]);
    }
    
    /**
     * Modify assigned meta
     * 
     * @return $this
     */
    protected function modifyAssignedMeta()
    {
        return $this;
    }
    
    /**
     * Modify meta
     * 
     * @param array $meta
     * @return array
     */
    public function modifyMeta(array $meta)
    {
        $this->setMeta($meta);
        $this->modifyAssignedMeta();
        return $this->getMeta();
    }
    
}