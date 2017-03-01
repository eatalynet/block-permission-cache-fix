<?php

class Eataly_BlockPermissionCacheFix_Model_Admin_Resource_Variable extends Mage_Admin_Model_Resource_Variable
{

    /**
     * Get allowed types - now returns the output of _generateCache() method
     *
     * @return array
     */
    public function getAllowedPaths()
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
        /** @var Mage_Admin_Model_Resource_Variable_Collection $collection */
        $collection = Mage::getResourceModel('admin/variable_collection');
        $collection->addFieldToFilter('is_allowed', array('eq' => 1));
        $data = $collection->getColumnValues('variable_name');
        $data = array_flip($data);
        Mage::app()->saveCache(
            Mage::helper('core')->jsonEncode($data),
            self::CACHE_ID,
            array(Mage_Core_Model_App::CACHE_TAG)
        );

        return $data;
    }
}
