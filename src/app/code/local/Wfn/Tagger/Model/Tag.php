<?php
/**
 * Tag model.
 */
class Wfn_Tagger_Model_Tag extends Mage_Core_Model_Abstract
{
    const MINIMUM_NAME_LENGTH = 3;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tag');
    }

    /**
     * {@inheritdoc}
     */
    protected function _beforeSave()
    {
        $validationResult = $this->validate();

        if ($validationResult !== true) {
            throw new Wfn_Tagger_Model_Validation_Exception(implode('', $validationResult));
        }

        parent::_beforeSave();
    }

    /**
     * Validate model data.
     *
     * @return true|array TRUE on success, array of errors on failure
     */
    public function validate()
    {
        $errors = [];

        if (!Zend_Validate::is(trim($this->name), 'NotEmpty')) {
            $errors[] = Mage::helper('wfn_tagger')->__('The tag name must not be empty.');
        } elseif (!Zend_Validate::is($this->name, 'StringLength', [self::MINIMUM_NAME_LENGTH])) {
            $errors[] = Mage::helper('wfn_tagger')
                ->__('The tag name must be at least %s characters long.', self::MINIMUM_NAME_LENGTH);
        }

        if (empty($errors)) {
            return true;
        }

        return $errors;
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
     * @param  string $tagName
     * @param  int $entityId
     * @param  One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @param  int $createdUid
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
