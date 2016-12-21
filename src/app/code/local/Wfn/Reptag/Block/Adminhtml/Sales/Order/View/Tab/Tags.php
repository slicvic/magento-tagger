<?php
/**
 * Order view tags tab.
 */
class Wfn_Reptag_Block_Adminhtml_Sales_Order_View_Tab_Tags
    extends Mage_Adminhtml_Block_Sales_Order_Abstract
    implements Mage_Adminhtml_Block_Widget_Tab_Interface
{
    /**
     * Define the block template.
     */
    public function _construct()
    {
        parent::_construct();
        $this->setTemplate('wfn-reptag/sales-order-view-tab-tags.phtml');
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
