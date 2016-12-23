<?php
/**
 * Tag relation model class.
 */
class Wfn_Tagger_Model_TagRelation extends Mage_Core_Model_Abstract
{
    /**
     * Allowed values for entity type column.
     */
    const ENTITY_TYPE_ORDER    = 'order';
    const ENTITY_TYPE_CUSTOMER = 'customer';

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        // Define resource model
        $this->_init('wfn_tagger/tagRelation');
    }
}
