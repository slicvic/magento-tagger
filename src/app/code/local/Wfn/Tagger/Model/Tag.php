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
     * Associate tag with a specific entity.
     *
     * @param int $entityId
     * @param One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     * @param int $createdUid
     */
    public function addRelation($entityId, $entityType, $createdUid)
    {
        $relation = Mage::getModel('wfn_tagger/tagRelation');

        $relation->setData([
            'tag_id' => $this->getId(),
            'entity_id' => $entityId,
            'entity_type' => $entityType,
            'created_uid' => $createdUid
        ]);

        $relation->save();
    }

    /**
     * Load by tag name or create a new instance.
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
        try {
            $this->getResource()->beginTransaction();

            // Check if tag already exists, and if not, create it
            $tag = static::loadByName($tagName);
            if (!$tag->getId()) {
                $tag->setData([
                    'name' => trim($tagName),
                    'created_uid' => $createdUid,
                ])->save();
            }

            // Assign entity to tag
            $tagRelation = Mage::getModel('wfn_tagger/tagRelation');
            $tagRelation->setData([
                'tag_id' => $tag->getId(),
                'entity_id' => $entityId,
                'entity_type' => $entityType,
                'created_uid' => $createdUid
            ])->save();

            $this->getResource()->commit();

        } catch (Exception $e) {
            $this->getResource()->rollback();
            throw $e;
        }
    }
}
