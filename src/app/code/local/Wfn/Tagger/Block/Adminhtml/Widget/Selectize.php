<?php
/**
 * Block for Selectize.js tagging widget.
 */
class Wfn_Tagger_Block_Adminhtml_Widget_Selectize
    extends Wfn_Tagger_Block_Adminhtml_Widget_Abstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct($entityId, $entityType)
    {
        parent::__construct($entityId, $entityType);
        $this->_template = 'wfn_tagger/widget/selectize.phtml';
        $this->addTagUrl = Mage::getUrl('wfn_tagger/widget_selectize/addtag');
        $this->removeTagUrl = Mage::getUrl('wfn_tagger/widget_selectize/removetag');
    }
}
