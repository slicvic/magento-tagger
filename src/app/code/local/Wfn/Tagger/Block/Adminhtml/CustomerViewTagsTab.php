<?php
/**
 * Customer view tags tab block.
 */
class Wfn_Tagger_Block_Adminhtml_CustomerViewTagsTab
    extends Mage_Adminhtml_Block_Sales_Order_Abstract
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    use Wfn_Tagger_Block_Adminhtml_TaggableTrait;

    /**
     * {@inheritdoc}
     */
    protected function initEntity()
    {
        $this->entity = Mage::registry('current_customer');
    }

    /**
     * {@inheritdoc}
     */
    protected function initEntityType()
    {
        $this->entityType = Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_CUSTOMER;
    }

    /**
     * {@inheritdoc}
     */
    protected function initTemplate()
    {
        $this->setTemplate('wfn_tagger/tags-tab.phtml');
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
