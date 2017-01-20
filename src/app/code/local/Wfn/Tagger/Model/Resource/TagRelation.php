<?php
/**
 * Tag relation resource model.
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
            'title' => Mage::helper('wfn_tagger')->__('Tag ID, Entity ID and Entity Type combination')
        ]];

        return $this;
    }

    /**
     * Delete a relation by tag ID, entity ID and entity type combination.
     *
     * @param int $tagId
     * @param int $entityId
     * @param One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @return int
     */
    public static function deleteByTagIdEntityIdAndEntityType($tagId, $entityId, $entityType)
    {
        $coreResource = Mage::getSingleton('core/resource');
        $connection = $coreResource->getConnection('core_read');

        return $connection->delete($coreResource->getTableName('wfn_tagger/relation'), [
            'tag_id = ?' => $tagId,
            'entity_id = ?' => $entityId,
            'entity_type = ?' => $entityType,
            ]);
    }

    /**
     * Create tag if it doesn't exist and add relation to entity.
     *
     * @param string $tagName
     * @param int $entityId
     * @param One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @param int $createdUid
     * @return Wfn_Tagger_Model_Tag
     * @throws Exception
     */
    public static function addRelationByTagName($tagName, $entityId, $entityType, $createdUid)
    {
        $tagResource = Mage::getResourceModel('wfn_tagger/tag');

        try {
            $tagResource->beginTransaction();

            // Check if tag already exists, and if not, create it
            $tag = Wfn_Tagger_Model_Resource_Tag::loadByName($tagName);
            if (!$tag->getId()) {
                $tag->name = ucwords(strtolower(trim($tagName)));
                $tag->created_uid = $createdUid;
                $tag->save();
            }

            // Assign tag to entity
            $tagRelation = Mage::getModel('wfn_tagger/tagRelation');
            $tagRelation->tag_id = $tag->getId();
            $tagRelation->entity_id = $entityId;
            $tagRelation->entity_type = $entityType;
            $tagRelation->created_uid = $createdUid;
            $tagRelation->save();

            $tagResource->commit();

            return $tag;
        } catch (Exception $e) {
            $tagResource->rollback();
            throw $e;
        }
    }
}
