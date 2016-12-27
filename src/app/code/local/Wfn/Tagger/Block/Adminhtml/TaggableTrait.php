<?php
/**
 * Trait for tags block.
 */
trait Wfn_Tagger_Block_Adminhtml_TaggableTrait
{
    /**
     * ID of the entity for tagging.
     *
     * @var int
     */
    public $entityId;

    /**
     * Type of the entity for tagging.
     *
     * @var One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants
     */
    public $entityType;

    /**
     * List of all tags.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $allTags;

    /**
     * List of tags assigned to entity.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $assignedTags;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->initTemplate();
        $this->initEntityId();
        $this->initEntityType();
        $this->initAllTags();
        $this->initAssignedTags();
    }

    /**
     * Initialize $this->entityId.
     */
    abstract protected function initEntityId();

    /**
     * Initialize $this->entityType.
     */
    abstract protected function initEntityType();

    /**
     * Initialize $this->_template.
     */
    abstract protected function initTemplate();

    /**
     * Initialize $this->allTags.
     */
    protected function initAllTags()
    {
        $this->allTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addFieldToSelect(['tag_id', 'name'])
            ->setOrder('name', 'ASC');
    }

    /**
     * Initialize $this->assignedTags.
     */
    protected function initAssignedTags()
    {
        $this->assignedTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addEntityFilter($this->entityId, $this->entityType)
            ->addFieldToSelect(['tag_id', 'name'])
            ->setOrder('name', 'ASC');
    }
}
