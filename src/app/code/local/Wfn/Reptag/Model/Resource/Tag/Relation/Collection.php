<?php
/**
 * This class defines a tag relation collection.
 */
class Wfn_Reptag_Model_Resource_Tag_Relation_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define the resource model.
     */
    protected function _construct()
    {
        $this->_init('wfn_reptag/tag_relation');
    }
}
