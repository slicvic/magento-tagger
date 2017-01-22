<?php
/**
 * Renderer for orders and customers grid tags column.
 */
class Wfn_Tagger_Block_Adminhtml_GridTagsColumnRenderer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    /**
     * {@inheritdoc}
     */
    public function render(Varien_Object $row)
    {
        $value = $row->getData($this->getColumn()->getIndex());
        if (empty($value)) {
            return '';
        }
        $style = 'background-color:#7f8c8d;color:#fff;padding:3px;margin:2px;border-radius:3px;';
        return "<div style=\"margin-top:4px\"><span style=\"$style\">" . str_replace(',', "</span><span style=\"$style\">", $value) . "</span></div>";
    }
}