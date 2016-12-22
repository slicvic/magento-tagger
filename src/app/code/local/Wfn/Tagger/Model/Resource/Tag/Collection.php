<?php
/**
 * Tag collection.
 */
class Wfn_Tagger_Model_Resource_Tag_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * Define the resource model.
     */
    protected function _construct()
    {
        $this->_init('wfn_tagger/tag');
    }
}
