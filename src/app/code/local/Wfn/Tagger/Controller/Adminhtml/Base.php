<?php
/**
 * Base admin controller.
 */
abstract class Wfn_Tagger_Controller_Adminhtml_Base extends Mage_Adminhtml_Controller_Action
{
    /**
     * Set a JSON response.
     *
     * @param  array  $data
     */
    protected function jsonResponse(array $data = [])
    {
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(json_encode($data));
    }
}
