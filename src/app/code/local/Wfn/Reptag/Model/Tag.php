<?php
/**
 * This class defines a tag model.
 */
class Wfn_Reptag_Model_Tag extends Mage_Core_Model_Abstract
{
    /**
     * Define the resource model.
     */
    protected function _construct()
    {
        $this->_init('wfn_reptag/tag');
    }
}
