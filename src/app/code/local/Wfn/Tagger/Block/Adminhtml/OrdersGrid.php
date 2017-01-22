<?php
/**
 * Block that overrides sales orders grid and adds "Tags" column.
 */
class Wfn_Tagger_Block_Adminhtml_OrdersGrid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    /**
     * {@inheritdoc}
     */
    protected function _getCollectionClass()
    {
        return 'wfn_tagger/orderGridCollection';
    }

    /**
     * {@inheritdoc}
     */
    protected function _prepareColumns()
    {
        $this->addColumnAfter('wfntags', [
            'header'   => Mage::helper('wfn_tagger')->__('Tags'),
            'index'    => 'wfntags',
            'sortable' => true,
            'width'    => '150px',
            'filter_condition_callback' => [$this, '_tagsFilterCallback'],
            'renderer' => 'Wfn_Tagger_Block_Adminhtml_GridTagsColumnRenderer'
        ], 'status');

        return parent::_prepareColumns();
    }

    /**
     * Callback that filters collection by tag name.
     *
     * @param Wfn_Tagger_Model_Resource_OrdersGridCollection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return $this
     */
    protected function _tagsFilterCallback($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }

        $collection->getSelect()->having('wfntags LIKE ?', "%$value%");

        return $this;
    }
}