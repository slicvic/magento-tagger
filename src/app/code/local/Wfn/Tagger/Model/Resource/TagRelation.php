<?php
/**
 * Tag relation resource model class.
 */
class Wfn_Tagger_Model_Resource_TagRelation extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define table and primary key (see config.xml for table config)
        $this->_init('wfn_tagger/relation', 'tag_relation_id');
    }

    /**
     * {@inheritdoc}
     */
    protected function _initUniqueFields()
    {
        // Tag ID, entity ID and entity type combination should be unique
        $this->_uniqueFields = [[
            'field' => ['tag_id', 'entity_id', 'entity_type'],
            'title' => Mage::helper('wfn_tagger')->__('Tag ID, Entity ID and Entity Type combination should be unique')
        ]];

        return $this;
    }
}
