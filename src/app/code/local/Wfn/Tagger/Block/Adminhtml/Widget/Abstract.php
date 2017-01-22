<?php
/**
 * Abstract block for rendering tagging widget.
 */
abstract class Wfn_Tagger_Block_Adminhtml_Widget_Abstract
    extends Mage_Adminhtml_Block_Template
{
    /**
     * ID of the entity to be tagged.
     *
     * @var int
     */
    public $entityId;

    /**
     * Type of the entity to be tagged.
     *
     * @var One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants
     */
    public $entityType;

    /**
     * List of tags assigned to entity.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $assignedTags;

    /**
     * List of all available tags.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $allTags;

    /**
     * Endpoint to tag entity.
     *
     * @var string
     */
    public $addTagUrl;

    /**
     * Endpoint to untag entity.
     *
     * @var string
     */
    public $removeTagUrl;

    /**
     * Constructor.
     *
     * @param int $entityId
     * @param One of the Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_* constants $entityType
     */
    public function __construct($entityId, $entityType)
    {
        parent::__construct();

        $this->entityId = $entityId;
        $this->entityType = $entityType;
        $this->addTagUrl = Mage::getUrl('wfn_tagger/widget_ajax/addtag');
        $this->removeTagUrl = Mage::getUrl('wfn_tagger/widget_ajax/removetag');

        $this->allTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addFieldToSelect(['tag_id', 'name'])
            ->setOrder('name', 'ASC');

        $this->assignedTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addEntityFilter($this->entityId, $this->entityType)
            ->addFieldToSelect(['tag_id', 'name'])
            ->setOrder('name', 'ASC');
    }
}
