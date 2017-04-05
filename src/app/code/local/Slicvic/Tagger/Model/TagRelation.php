<?php
/**
 * Tag relation model.
 */
class Slicvic_Tagger_Model_TagRelation extends Mage_Core_Model_Abstract
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
        $this->_init('slicvic_tagger/tagRelation');
    }

    /**
     * {@inheritdoc}
     */
    protected function _beforeSave()
    {
        $validationResult = $this->validate();

        if ($validationResult !== true) {
            throw new Slicvic_Tagger_Model_Validation_Exception(implode('', $validationResult));
        }

        parent::_beforeSave();
    }

    /**
     * Validate model data.
     *
     * @return true|array True on success, array of errors on failure
     */
    public function validate()
    {
        $errors = [];

        if (!Zend_Validate::is($this->getData('entity_id'), 'Digits')) {
            $errors[] = Mage::helper('slicvic_tagger')->__('Entity ID must contain only digits.');
        }

        if (!static::isValidEntityType($this->getData('entity_type'))) {
            $errors[] = Mage::helper('slicvic_tagger')->__('Entity type is invalid.');
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
        return (in_array($entityType, [
            static::ENTITY_TYPE_ORDER,
            static::ENTITY_TYPE_CUSTOMER,
            ]));
    }
}
