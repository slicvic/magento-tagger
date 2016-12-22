<?php
/**
 * Tag relation model.
 */
class Wfn_Tagger_Model_Tag_Relation extends Mage_Core_Model_Abstract
{
    /**
     * Allowed entity types.
     */
    const ENTITY_TYPE_ORDER    = 'order';
    const ENTITY_TYPE_CUSTOMER = 'customer';

    /**
     * Define the resource model.
     */
    protected function _construct()
    {
        $this->_init('wfn_tagger/tag_relation');
    }
}
