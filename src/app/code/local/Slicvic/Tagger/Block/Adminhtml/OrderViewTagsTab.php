<?php
/**
 * Block for order view page "Tags" tab.
 */
class Slicvic_Tagger_Block_Adminhtml_OrderViewTagsTab
    extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_template = 'slicvic_tagger/order-view-tags-tab.phtml';

        $this->setChild('tag_widget', new Slicvic_Tagger_Block_Adminhtml_Widget_Selectize(
            Mage::registry('current_order')->getId(),
            Slicvic_Tagger_Model_TagRelation::ENTITY_TYPE_ORDER
        ));
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
