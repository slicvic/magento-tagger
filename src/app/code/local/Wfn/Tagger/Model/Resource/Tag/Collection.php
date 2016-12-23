<?php
/**
 * Tag collection class.
 */
class Wfn_Tagger_Model_Resource_Tag_Collection
    extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tag');
    }

    /**
     * Filter collection to get tags for a specific entity.
     *
     * @param int $entityId
     * @param string $entityType
     * @return $this
     */
    public function addEntityFilter($entityId, $entityType)
    {
        $this->getSelect()
             ->join(['tr' => Mage::getSingleton('core/resource')->getTableName('wfn_tagger/relation')],  'main_table.tag_id = tr.tag_id')
             ->where('tr.entity_id = ?', $entityId)
             ->where('tr.entity_type = ?', $entityType);

        return $this;
    }
}
