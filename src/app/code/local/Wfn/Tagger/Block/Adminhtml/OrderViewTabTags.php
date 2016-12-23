<?php
/**
 * Block class for order view "Tags" tab.
 */
class Wfn_Tagger_Block_Adminhtml_OrderViewTabTags
    extends Mage_Adminhtml_Block_Sales_Order_Abstract
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    use Wfn_Tagger_Block_Adminhtml_TagsTrait;

    /**
     * {@inheritdoc}
     */
    protected function initEntity()
    {
        $this->entity = Mage::registry('current_order');
    }

    /**
     * {@inheritdoc}
     */
    protected function initEntityType()
    {
        $this->entityType = Wfn_Tagger_Model_Tag_Relation::ENTITY_TYPE_ORDER;
    }

    /**
     * {@inheritdoc}
     */
    protected function initTemplate()
    {
        $this->setTemplate('wfn_tagger/order-view-tab-tags.phtml');
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
