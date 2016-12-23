<?php
/**
 * Tag model class.
 */
class Wfn_Tagger_Model_Tag extends Mage_Core_Model_Abstract
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tag');
    }
}
