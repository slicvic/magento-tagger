<?php
/**
 * Order view tags tab class.
 */
class Wfn_Tagger_Block_Adminhtml_Sales_Order_View_Tab_Tags
    extends Mage_Adminhtml_Block_Sales_Order_Abstract
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Current order model.
     *
     * @var Mage_Sales_Model_Order
     */
    protected $order;

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
     * Tags assigned to order.
     *
     * @var Wfn_Tagger_Model_Resource_Tag_Collection
     */
    public $assignedTags;

    /**
     * Tag IDs assigned to order.
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

        // Define template file
        $this->setTemplate('wfn_tagger/sales-order-view-tab-tags.phtml');

        // Set current order
        $this->order = Mage::registry('current_order');

        // Retrieve all tags
        $this->allTags = Mage::getModel('wfn_tagger/tag')
            ->getCollection()
            ->addFieldToSelect(['tag_id', 'name']);

        // Convert tags to JSON string
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
            ->addOrderFilter($this->order->getId())
            ->addFieldToSelect(['tag_id', 'name']);

        // Extract assigned tag IDs
        $this->assignedTagIds = [];
        foreach ($this->assignedTags as $tag) {
            $this->assignedTagIds[] = $tag->getId();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getTabLabel()
    {
        return $this->__('Tags');
    }

    /**
     * {@inheritdoc}
     */
    public function getTabTitle()
    {
        return $this->__('Tags');
    }

    /**
     * {@inheritdoc}
     */
    public function canShowTab()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isHidden()
    {
        return false;
    }
}
