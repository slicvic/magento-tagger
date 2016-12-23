<?php
/**
 * Tag relation collection.
 */
class Wfn_Tagger_Model_Resource_TagRelation_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tagRelation');
    }
}
