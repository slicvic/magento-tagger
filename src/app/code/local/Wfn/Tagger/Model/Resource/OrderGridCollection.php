<?php
/**
 * Collection that extends sales order grid collection to add ability to
 * filter orders by tag.
 */
class Wfn_Tagger_Model_Resource_OrderGridCollection extends Mage_Sales_Model_Resource_Order_Grid_Collection
{
    /**
     * {@inheritdoc}
     */
    protected function _initSelect()
    {
        parent::_initSelect();
        $this->getSelect()->columns($this->getSelectTagsSql());
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getSelectCountSql()
    {
        $countSelect = parent::getSelectCountSql();

        if (false === strpos($countSelect, 'wfntags')) {
            return $countSelect;
        }

        $countSelect->reset(Zend_Db_Select::COLUMNS);
        $countSelect->columns($this->getSelectTagsSql());

        return "SELECT COUNT(*) FROM ($countSelect) AS tbl";
    }

    /**
     * Get SQL for retreiving an order's tags.
     *
     * @return string
     */
    protected function getSelectTagsSql()
    {
        $tagTable = Mage::getSingleton('core/resource')->getTableName('wfn_tagger/tag');
        $tagRelationTable = Mage::getSingleton('core/resource')->getTableName('wfn_tagger/relation');
        $sql = "(
            SELECT GROUP_CONCAT(DISTINCT t.name SEPARATOR ',')
            FROM $tagTable t
            JOIN $tagRelationTable tr ON t.tag_id = tr.tag_id
            WHERE (tr.entity_type = 'order' AND tr.entity_id = main_table.entity_id)
               OR (tr.entity_type = 'customer' AND tr.entity_id = main_table.customer_id)
            ) AS wfntags";

        return $sql;
    }
}
