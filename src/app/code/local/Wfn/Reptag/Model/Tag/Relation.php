<?php
/**
 * This class defines a tag relation model.
 */
class Wfn_Reptag_Model_Tag_Relation extends Mage_Core_Model_Abstract
{
    /**
     * Types of entities.
     */
    const ENTITY_TYPE_ORDER    = 'order';
    const ENTITY_TYPE_CUSTOMER = 'customer';

    /**
     * Define the resource model.
     */
    protected function _construct()
    {
        $this->_init('wfn_reptag/tag_relation');
    }
}
