<?php
/**
 * Tag relation resource model.
 */
class Slicvic_Tagger_Model_Resource_TagRelation extends Mage_Core_Model_Resource_Db_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define table and primary key (see config.xml for table config)
        $this->_init('slicvic_tagger/relation', 'tag_relation_id');
    }

    /**
     * {@inheritdoc}
     */
    protected function _initUniqueFields()
    {
        // Tag ID, entity ID and entity type combination should be unique
        $this->_uniqueFields = [[
            'field' => ['tag_id', 'entity_id', 'entity_type'],
            'title' => Mage::helper('slicvic_tagger')->__('Tag ID, Entity ID and Entity Type combination')
        ]];

        return $this;
    }

    /**
     * Delete a relation by tag ID, entity ID and entity type combination.
     *
     * @param int $tagId
     * @param int $entityId
     * @param One of the Slicvic_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @return int
     */
    public static function deleteByTagIdEntityIdAndEntityType($tagId, $entityId, $entityType)
    {
        $coreResource = Mage::getSingleton('core/resource');
        $connection = $coreResource->getConnection('core_read');

        return $connection->delete($coreResource->getTableName('slicvic_tagger/relation'), [
            'tag_id = ?' => $tagId,
            'entity_id = ?' => $entityId,
            'entity_type = ?' => $entityType,
            ]);
    }
}
