<?php
/**
 * Block that overrides customers grid to add "Tags" column.
 */
class Wfn_Tagger_Block_Adminhtml_CustomersGrid extends Mage_Adminhtml_Block_Customer_Grid
{
    /**
     * {@inheritdoc}
     */
    protected function _prepareColumns()
    {
        $this->addColumnAfter('wfntags', [
            'header' => Mage::helper('wfn_tagger')->__('Tags'),
            'index' => 'wfntags',
            'sortable' => true,
            'width' => '150px',
            'filter_condition_callback' => [$this, '_tagsFilterCallback'],
            'renderer' => 'Wfn_Tagger_Block_Adminhtml_GridTagsColumnRenderer'
        ], 'customer_since');

        return parent::_prepareColumns();
    }

    /**
     * Callback that filters collection by tag.
     *
     * @param Wfn_Tagger_Model_Resource_CustomersGridCollection $collection
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