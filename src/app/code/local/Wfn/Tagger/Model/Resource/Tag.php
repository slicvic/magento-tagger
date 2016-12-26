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

    /**
     * Create a tag and associate it with an entity.
     *
     * @param string $tagName
     * @param int $entityId
     * @param One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @param int $createdUid
     * @throws Exception
     */
    public static function createTagAndAssignEntity($tagName, $entityId, $entityType, $createdUid)
    {
        $tagResource = Mage::getResourceModel('wfn_tagger/tag');

        try {
            $tagResource->beginTransaction();

            // Check if tag already exists, and if not, create it
            $tag = static::loadByName($tagName);
            if (!$tag->getId()) {
                $tag->name = trim($tagName);
                $tag->created_uid = $createdUid;
                $tag->save();
            }

            // Assign entity to tag
            $tagRelation = Mage::getModel('wfn_tagger/tagRelation');
            $tagRelation->tag_id = $tag->getId();
            $tagRelation->entity_id = $entityId;
            $tagRelation->entity_type = $entityType;
            $tagRelation->created_uid = $createdUid;
            $tagRelation->save();

            $tagResource->commit();

        } catch (Exception $e) {
            $tagResource->rollback();
            throw $e;
        }
    }
}
