<?php
/**
 * Input widget for tagging entities.
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
    }
}
