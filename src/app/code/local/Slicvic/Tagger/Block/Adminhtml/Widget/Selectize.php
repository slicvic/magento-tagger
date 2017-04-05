<?php
/**
 * Block for Selectize.js tagging widget.
 */
class Slicvic_Tagger_Block_Adminhtml_Widget_Selectize
    extends Slicvic_Tagger_Block_Adminhtml_Widget_Abstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct($entityId, $entityType)
    {
        parent::__construct($entityId, $entityType);
        $this->_template = 'slicvic_tagger/widget/selectize.phtml';
        $this->addTagUrl = Mage::getUrl('slicvic_tagger/widget_selectize/addtag');
        $this->removeTagUrl = Mage::getUrl('slicvic_tagger/widget_selectize/removetag');
    }
}
