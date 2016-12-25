<?php
/**
 * Tag relation model.
 */
class Wfn_Tagger_Model_TagRelation extends Mage_Core_Model_Abstract
{
    /**
     * Allowed values for entity type field.
     */
    const ENTITY_TYPE_ORDER    = 'order';
    const ENTITY_TYPE_CUSTOMER = 'customer';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tagRelation');
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

        if (!Zend_Validate::is($this->entity_id, 'Digits')) {
            $errors[] = Mage::helper('wfn_tagger')->__('The entity id must only contain digits.');
        }

        if (!static::isValidEntityType($this->entity_type)) {
            $errors[] = Mage::helper('wfn_tagger')->__('The entity type is invalid.');
        }

        if (empty($errors)) {
            return true;
        }

        return $errors;
    }

    /**
     * Check if an entity type is valid.
     *
     * @param  string $entityType
     * @return bool
     */
    public static function isValidEntityType($entityType)
    {
        return (in_array($entityType, array(
            static::ENTITY_TYPE_ORDER,
            static::ENTITY_TYPE_CUSTOMER,
        )));
    }
}
