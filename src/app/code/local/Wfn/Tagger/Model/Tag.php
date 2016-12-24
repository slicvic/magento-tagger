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
     * Validate model data.
     * 
     * @return true|array TRUE on success, array of errors on failure
     */
    public function validate()
    {
        $errors = [];
                
        
        if (!Zend_Validate::is(trim($this->name), 'NotEmpty')) {
            $errors[] = Mage::helper('wfn_tagger')->__('The tag name must not be empty');
        } elseif (!Zend_Validate::is($this->name, 'StringLength', [self::MINIMUM_NAME_LENGTH])) {
            $errors[] = Mage::helper('wfn_tagger')
                ->__('The tag name must be at least %s characters long', self::MINIMUM_NAME_LENGTH);
        }
        
        if (empty($errors)) {
            return true;
        }
        
        return $errors;
    }
}
