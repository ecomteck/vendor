<?php
/**
 * Copyright © eComBricks. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Ecombricks\Ui\Framework;

/**
 * Data merger
 */
class DataMerger
{
    
    /**
     * Check if array is indexed
     * 
     * @param array $array
     * @return boolean
     */
    protected function isIndexedArray($array)
    {
        return is_int(key($array));
    }
    
    /**
     * Merge recursive
     * 
     * @param array $originalData
     * @param array $data
     * @return array
     */
    protected function mergeRecursive($originalData, $data)
    {
        foreach ($data as $key => $value) {
            if (is_array($value) && !$this->isIndexedArray($value) && array_key_exists($key, $originalData)) {
                $originalData[$key] = $this->mergeRecursive($originalData[$key], $value);
            } else {
                $originalData[$key] = $data[$key];
            }
        }
        return $originalData;
    }
    
    /**
     * Merge
     * 
     * @param array $originalData
     * @param array $data
     * @return array
     */
    public function merge($originalData, $data)
    {
        return $this->mergeRecursive($originalData, $data);
    }
    
}