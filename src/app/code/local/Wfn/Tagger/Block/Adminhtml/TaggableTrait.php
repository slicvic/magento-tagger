<?php
/**
 * Trait for tags block.
 */
trait Wfn_Tagger_Block_Adminhtml_TaggableTrait
{
    /**
     * An instance of the model class to be tagged.
     *
     * @var Mage_Sales_Model_Order|Mage_Customer_Model_Customer
     */
    public $entity;

    /**
     * Type of the entity.
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
        $this->initEntity();
        $this->initEntityType();
        $this->initAllTags();
        $this->initAssignedTags();
    }

    /**
     * Initialize $this->entity.
     */
    abstract protected function initEntity();

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
                    ->addEntityFilter($this->entity->getId(), $this->entityType)
                    ->addFieldToSelect(['tag_id', 'name']);

        foreach ($tags as $tag) {
            $this->assignedTags[$tag->getId()] = [
                'id' => $tag->getId(),
                'name' => $tag->getName()
            ];
        }
    }
}
