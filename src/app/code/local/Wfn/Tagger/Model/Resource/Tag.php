<?php
/**
 * Tag resource model.
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

    /**
     * Load a tag by name.
     *
     * @param string $name
     * @return Wfn_Tagger_Model_Tag
     */
    public static function loadByName($name)
    {
        $tag = Mage::getModel('wfn_tagger/tag');
        $tag->load($name, 'name');

        return $tag;
    }
}
