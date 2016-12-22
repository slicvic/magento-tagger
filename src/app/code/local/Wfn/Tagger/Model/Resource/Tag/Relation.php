<?php
/**
 * Tag relation resource model.
 */
class Wfn_Tagger_Model_Resource_Tag_Relation extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * Define the table and primary key.
     */
    protected function _construct()
    {
        $this->_init('wfn_tagger/relation', 'tag_relation_id');
    }

    /**
     * Define unique fields.
     *
     * @return $this
     */
    protected function _initUniqueFields()
    {
        $this->_uniqueFields = [[
            'field' => ['tag_id', 'entity_id', 'entity_type'],
            'title' => Mage::helper('wfn_tagger')->__('Tag ID, Entity ID and Entity Type combination should be unique')
        ]];

        return $this;
    }
}
