<?php
/**
 * Tag relation collection class.
 */
class Wfn_Tagger_Model_Resource_Tag_Relation_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tag_relation');
    }
}
