<?php
/**
 * Tag model.
 */
class Wfn_Tagger_Model_Tag extends Mage_Core_Model_Abstract
{
    /**
     * Define the resource model.
     */
    protected function _construct()
    {
        $this->_init('wfn_tagger/tag');
    }
}
