<?php
/**
 * Tag relation model class.
 */
class Wfn_Tagger_Model_TagRelation extends Mage_Core_Model_Abstract
{
    /**
     * Allowed values for entity type field.
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

    /**
     * Check if an entity type is valid.
     *
     * @param  string $entityType
     * @return bool
     */
    public static function isValidEntityType($entityType)
    {
        return (in_array($entityType, array(
            self::ENTITY_TYPE_ORDER,
            self::ENTITY_TYPE_CUSTOMER,
        )));
    }
}
