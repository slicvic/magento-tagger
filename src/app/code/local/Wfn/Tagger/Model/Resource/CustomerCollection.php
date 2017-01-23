<?php
/**
 * Collection that filters customers by tag.
 */
class Wfn_Tagger_Model_Resource_CustomerCollection extends Mage_Customer_Model_Resource_Customer_Collection
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
     * {@inheritdoc}
     */
    protected function _getAllIdsSelect($limit = null, $offset = null)
    {
        $idsSelect = parent::_getAllIdsSelect($limit, $offset);
        $idsSelect->columns($this->getSelectTagsSql());
        return $idsSelect;
    }

    /**
     * Get SQL for retreiving a customer's tags.
     *
     * @return string
     */
    public function getSelectTagsSql()
    {
        $tagTable = Mage::getSingleton('core/resource')->getTableName('wfn_tagger/tag');
        $tagRelationTable = Mage::getSingleton('core/resource')->getTableName('wfn_tagger/relation');
        $sql = "(
            SELECT GROUP_CONCAT(t.name SEPARATOR ',') 
            FROM $tagTable t
            JOIN $tagRelationTable tr ON t.tag_id = tr.tag_id
            WHERE (tr.entity_type = 'customer' AND tr.entity_id = e.entity_id)
            ) AS wfntags";

        return $sql;
    }
}