<?php
/**
 * Block that extends sales orders grid to add "Tags" column.
 */
class Slicvic_Tagger_Block_Adminhtml_OrdersGrid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
    /**
     * {@inheritdoc}
     */
    protected function _prepareColumns()
    {
        $this->addColumnAfter('slicvictags', [
            'header'   => Mage::helper('slicvic_tagger')->__('Tags'),
            'index'    => 'slicvictags',
            'sortable' => true,
            'width'    => '150px',
            'filter_condition_callback' => [$this, '_tagsFilterCallback'],
            'renderer' => 'Slicvic_Tagger_Block_Adminhtml_GridTagsColumnRenderer'
        ], 'status');

        return parent::_prepareColumns();
    }

    /**
     * Callback that filters collection by tag.
     *
     * @param Slicvic_Tagger_Model_Resource_OrdersGridCollection $collection
     * @param Mage_Adminhtml_Block_Widget_Grid_Column $column
     * @return $this
     */
    protected function _tagsFilterCallback($collection, $column)
    {
        if (!$value = $column->getFilter()->getValue()) {
            return $this;
        }

        $collection->getSelect()->having('slicvictags LIKE ?', "%$value%");

        return $this;
    }
}
