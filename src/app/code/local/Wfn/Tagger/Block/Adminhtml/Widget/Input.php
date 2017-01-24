<?php
/**
 * Block for rendering input tagging widget.
 */
class Wfn_Tagger_Block_Adminhtml_Widget_Input
    extends Wfn_Tagger_Block_Adminhtml_Widget_Abstract
{
    /**
     * {@inheritdoc}
     */
    public function __construct($entityId, $entityType)
    {
        parent::__construct($entityId, $entityType);
        $this->_template = 'wfn_tagger/widget/input.phtml';
        $this->addTagUrl = Mage::getUrl('wfn_tagger/widget_input/addtag');
        $this->removeTagUrl = Mage::getUrl('wfn_tagger/widget_input/removetag');
    }
}
