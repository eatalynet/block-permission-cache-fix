<?php

class Eataly_BlockPermissionCacheFix_Model_Admin_Resource_Block extends Mage_Admin_Model_Resource_Block
{

    /**
     * Get allowed types - now returns the output of _generateCache() method
     *
     * @return array
     */
    public function getAllowedTypes()
    {
        $data = Mage::app()->getCacheInstance()->load(self::CACHE_ID);
        if ($data === false) {
            return $this->_generateCache();
        }
        return Mage::helper('core')->jsonDecode($data);
    }

    /**
     * Regenerate cache - now returns the $data retrieved
     *
     * @return array
     */
    protected function _generateCache()
    {
        /** @var Mage_Admin_Model_Resource_Block_Collection $collection */
        $collection = Mage::getResourceModel('admin/block_collection');
        $collection->addFieldToFilter('is_allowed', array('eq' => 1));
        $data = $collection->getColumnValues('block_name');
        $data = array_flip($data);
        Mage::app()->saveCache(
            Mage::helper('core')->jsonEncode($data),
            self::CACHE_ID,
            array(Mage_Core_Model_App::CACHE_TAG)
        );

        return $data;
    }
}
