<?php
/**
 * This class defines a tag relation resource model.
 */
class Wfn_Reptag_Model_Resource_Tag_Relation extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define the main table and primary key.
     */
    protected function _construct()
    {
        $this->_init('wfn_reptag/relation', 'tag_relation_id');
    }

    /**
     * Define unique fields.
     *
     * @return $this
     */
    protected function _initUniqueFields()
    {

    }
}
