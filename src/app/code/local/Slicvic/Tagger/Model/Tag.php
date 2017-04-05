<?php
/**
 * Tag model.
 */
class Slicvic_Tagger_Model_Tag extends Mage_Core_Model_Abstract
{
    const MINIMUM_NAME_LENGTH = 3;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('slicvic_tagger/tag');
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

        $this->setData('name', ucwords(strtolower(trim($this->getData('name')))));

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

        if (!Zend_Validate::is($this->getData('name'), 'Regex', ['pattern' => sprintf('/^[a-zA-Z\s]{%s,}$/', self::MINIMUM_NAME_LENGTH)])) {
            $errors[] = Mage::helper('slicvic_tagger')
                ->__('Tags must be at least %s characters long and contain only letters and spaces.', self::MINIMUM_NAME_LENGTH);
        }

        if (empty($errors)) {
            return true;
        }

        return $errors;
    }
}
