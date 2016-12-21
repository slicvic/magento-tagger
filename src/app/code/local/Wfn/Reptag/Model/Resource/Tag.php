<?php
/**
 * This class defines a tag resource model.
 */
class Wfn_Reptag_Model_Resource_Tag extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define the main table and primary key.
     */
    protected function _construct()
    {
        $this->_init('wfn_reptag/tag', 'tag_id');
    }

    /**
     * Define unique fields.
     *
     * @return $this
     */
    protected function _initUniqueFields()
    {
        $this->_uniqueFields = [[
            'field' => 'name',
            'title' => Mage::helper('tag')->__('Tag')
        ]];

        return $this;
    }
}
