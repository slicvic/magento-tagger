<?php
/**
 * Tag blocks trait.
 */
trait Wfn_Tagger_Block_Adminhtml_TagsTrait
{
    /**
     * Entity to be tagged.
     *
     * @var Mage_Sales_Model_Order|Mage_Customer_Model_Customer
     */
    protected $entity;

    /**
     * Type of entity to be tagged.
     *
     * @var Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_*
     */
    protected $entityType;

    /**
     * All available tags.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $allTags;

    /**
     * All available tags as JSON string.
     *
     * @var string
     */
    public $allTagsJSON;

    /**
     * Tags assigned to entity.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $assignedTags;

    /**
     * Tag IDs assigned to entity.
     *
     * @var array
     */
    public $assignedTagIds;

    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        parent::_construct();
        $this->initTemplate();
        $this->initEntity();
        $this->initEntityType();
        $this->initTags();
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
     * Initialize tags.
     */
    public function initTags()
    {
        // Retrieve all tags
        $this->allTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addFieldToSelect(['tag_id', 'name']);

        // Convert to JSON string
        $this->allTagsJSON = [];
        foreach ($this->allTags as $tag) {
            $this->allTagsJSON[] = [
                'id' => $tag->getId(),
                'name' => $tag->getName()
            ];
        }
        $this->allTagsJSON = json_encode($this->allTagsJSON);

        // Retrieve assigned tags
        $this->assignedTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addEntityFilter($this->entity->getId(), $this->entityType)
            ->addFieldToSelect(['tag_id', 'name']);

        // Extract tag IDs
        $this->assignedTagIds = [];
        foreach ($this->assignedTags as $tag) {
            $this->assignedTagIds[] = $tag->getId();
        }
    }
}
