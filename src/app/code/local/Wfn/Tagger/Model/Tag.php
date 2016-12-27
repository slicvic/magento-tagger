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
     * @return true|array True on success, array of errors on failure
     */
    public function validate()
    {
        $errors = [];

        if (!Zend_Validate::is(trim($this->name), 'NotEmpty')) {
            $errors[] = Mage::helper('wfn_tagger')->__('Tag name must not be blank.');
        } else if (!preg_match('/^[a-zA-Z0-9\s-.@]+$/', $this->name)) {
            $errors[] = Mage::helper('wfn_tagger')->__('Tag name must contain only letters, numbers, spaces, and -.@');
        } elseif (!Zend_Validate::is($this->name, 'StringLength', [self::MINIMUM_NAME_LENGTH])) {
            $errors[] = Mage::helper('wfn_tagger')
                ->__('Tag name must be at least %s characters long.', self::MINIMUM_NAME_LENGTH);
        }

        if (empty($errors)) {
            return true;
        }

        return $errors;
    }
}
