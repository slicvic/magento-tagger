<?php
/**
 * Block for rendering the tags tab on customer edit page.
 */
class Wfn_Tagger_Block_Adminhtml_CustomerEditTagsTab
    extends Mage_Adminhtml_Block_Template
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * {@inheritdoc}
     */
    protected function _construct()
    {
        $this->_template = 'wfn_tagger/customer-edit-tags-tab.phtml';

        $this->setChild('tag_widget', new Wfn_Tagger_Block_Adminhtml_Widget_Input(
            Mage::registry('current_customer')->getId(),
            Wfn_Tagger_Model_TagRelation::ENTITY_TYPE_CUSTOMER
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
