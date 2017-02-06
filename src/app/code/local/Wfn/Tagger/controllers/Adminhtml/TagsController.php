<?php
/**
 * Controller for creating, deleting and updating tags.
 */
class Wfn_Tagger_Adminhtml_TagsController extends Wfn_Tagger_Controller_Adminhtml_Base
{
    /**
     * List all tags.
     */
    public function indexAction()
    {
        $this
            ->_title($this->__('WFN'))
            ->_title($this->__('Tagger'))
            ->_title($this->__('Manage Tags'));
        $this->loadLayout();
        $this->_setActiveMenu('system');
        $this->getLayout()->getBlock('tags');
        $this->renderLayout();
    }

    /**
     * Create a new tag.
     */
    public function createAction()
    {
        $params = [
            'name' => $this->getRequest()->getParam('name'),
            'user_id' => $this->getRequest()->getParam('user_id')
        ];

        try {
            $tag = Mage::getModel('wfn_tagger/tag')
                ->setName($params['name'])
                ->setUserId($params['user_id'] ?: null)
                ->setCreatedUid(Mage::getSingleton('admin/session')->getUser()->getUserId())
                ->save();
            $this->_getSession()->addSuccess(sprintf('Created tag "%s"', $tag->getName()));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->jsonResponse();
    }

    /**
     * Update existing tag.
     */
    public function updateAction()
    {
        $id = $this->getRequest()->getParam('id');
        $params = [
            'name' => $this->getRequest()->getParam('name'),
            'user_id' => $this->getRequest()->getParam('user_id')
        ];

        $tag = Mage::getModel('wfn_tagger/tag')->load($id);

        if (!$tag->getId()) {
            $this->_getSession()->addError("Tag ID $id not found.");
            return $this->jsonResponse();
        }

        try {
            $tag
                ->setName($params['name'])
                ->setUserId($params['user_id'] ?: null)
                ->save();
            $this->_getSession()->addSuccess(sprintf('Updated tag "%s"', $tag->getName()));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->jsonResponse();
    }

    /**
     * Delete a tag.
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        $tag = Mage::getModel('wfn_tagger/tag')->load($id);

        if (!$tag->getId()) {
            $this->_getSession()->addError("Tag ID $id not found.");
            return $this->jsonResponse();
        }

        try {
            $tag->delete();
            $this->_getSession()->addSuccess(sprintf('Deleted tag "%s"', $tag->getName()));
        } catch (Exception $e) {
            $this->_getSession()->addError('Failed to delete tag: ' . $e->getMessage());
        }

        return $this->jsonResponse();
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        // Only allow admins
        return true;
    }
}
