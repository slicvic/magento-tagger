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
     * @var [][] In the form of: [['id' => 'Tag ID', 'name' => 'Tag Name'], ...]
     */
    public $allTags;

    /**
     * List of tags assigned to entity.
     *
     * @var [][] In the form of: [['id' => 'Tag ID', 'name' => 'Tag Name'], ...]
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
        $this->allTags = [];

        $tags = Mage::getModel('wfn_tagger/tag')
                    ->getCollection()
                    ->addFieldToSelect(['tag_id', 'name']);

        foreach ($tags as $tag) {
            $this->allTags[] = [
                'id' => $tag->getId(),
                'name' => $tag->getName()
            ];
        }
    }

    /**
     * Initialize $this->assignedTags.
     */
    protected function initAssignedTags()
    {
        $this->assignedTags = [];

        $tags = Mage::getModel('wfn_tagger/tag')
                    ->getCollection()
                    ->addEntityFilter($this->entityId, $this->entityType)
                    ->addFieldToSelect(['tag_id', 'name']);

        foreach ($tags as $tag) {
            $this->assignedTags[$tag->getId()] = [
                'id' => $tag->getId(),
                'name' => $tag->getName()
            ];
        }
    }
}
