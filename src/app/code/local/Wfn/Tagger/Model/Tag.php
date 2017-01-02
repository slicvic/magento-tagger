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

        if (!Zend_Validate::is($this->name, 'Regex', ['pattern' => sprintf('/^[a-zA-Z0-9\s-.@]{%s,}$/', self::MINIMUM_NAME_LENGTH)])) {
            $errors[] = Mage::helper('wfn_tagger')
                ->__('Tag name must be at least %s characters long and contain only letters, numbers, spaces, and -.@', self::MINIMUM_NAME_LENGTH);
        }

        if (empty($errors)) {
            return true;
        }

        return $errors;
    }
}
