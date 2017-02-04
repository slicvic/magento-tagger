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
     * Create tag if it doesn't exist and add relation to entity.
     *
     * @param string $tagName
     * @param int $entityId
     * @param One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @param int $createdUid
     * @return Wfn_Tagger_Model_Tag
     * @throws Exception
     */
    public static function createTagAndRelation($tagName, $entityId, $entityType, $createdUid)
    {
        $tagResource = Mage::getResourceModel('wfn_tagger/tag');

        try {
            $tagResource->beginTransaction();

            $tag = Wfn_Tagger_Model_Resource_Tag::loadByName($tagName);

            // Check if tag already exists, and if not, create it
            if (!$tag->getId()) {
                $tag->setData('name', $tagName)
                    ->setData('created_uid', $createdUid)
                    ->save();
            }

            // Create relation
            Mage::getModel('wfn_tagger/tagRelation')
                ->setData('tag_id', $tag->getId())
                ->setData('entity_id', $entityId)
                ->setData('entity_type', $entityType)
                ->setData('created_uid', $createdUid)
                ->save();

            $tagResource->commit();

            return $tag;
        } catch (Exception $e) {
            $tagResource->rollback();
            throw $e;
        }
    }
}
