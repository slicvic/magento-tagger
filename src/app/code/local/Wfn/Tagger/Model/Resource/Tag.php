<?php
/**
 * Tag resource model class.
 */
class Wfn_Tagger_Model_Resource_Tag extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define table and primary key (see config.xml for table config)
        $this->_init('wfn_tagger/tag', 'tag_id');
    }

    /**
     * {@inheritdoc}
     */
    protected function _initUniqueFields()
    {
        // Name should be unique
        $this->_uniqueFields = [[
            'field' => 'name',
            'title' => Mage::helper('wfn_tagger')->__('Tag')
        ]];

        return $this;
    }
}
