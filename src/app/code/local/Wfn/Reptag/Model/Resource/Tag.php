<?php
/**
 * Tag resource model.
 */
class Wfn_Reptag_Model_Resource_Tag extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define the table and primary key.
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
        // Name field should be unique
        $this->_uniqueFields = [[
            'field' => 'name',
            'title' => Mage::helper('wfn_reptag')->__('Tag')
        ]];

        return $this;
    }
}
