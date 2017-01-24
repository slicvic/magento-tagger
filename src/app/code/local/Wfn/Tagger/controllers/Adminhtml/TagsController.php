<?php
/**
 * Controller for creating, deleting and updating tags.
 */
class Wfn_Tagger_Adminhtml_TagsController extends Mage_Adminhtml_Controller_Action
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
            $this->_getSession()->addSuccess(sprintf('Tag "%s" created.', $tag->getName()));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('*/*/index');
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
            $this->_getSession()->addError('Tag not found.');
            return $this->_redirect('*/*/index');
        }

        try {
            $tag
                ->setName($params['name'])
                ->setUserId($params['user_id'] ?: null)
                ->save();
            $this->_getSession()->addSuccess(sprintf('Tag "%s" updated.', $tag->getName()));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('*/*/index');
    }

    /**
     * Delete a tag.
     */
    public function deleteAction()
    {
        $id = $this->getRequest()->getParam('id');
        $tag = Mage::getModel('wfn_tagger/tag')->load($id);

        if (!$tag->getId()) {
            $this->_getSession()->addError('Tag not found.');
            return $this->_redirect('*/*/index');
        }

        try {
            $tag->delete();
            $this->_getSession()->addSuccess(sprintf('Tag "%s" deleted.', $tag->getName()));
        } catch (Exception $e) {
            $this->_getSession()->addError($e->getMessage());
        }

        return $this->_redirect('*/*/index');
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
