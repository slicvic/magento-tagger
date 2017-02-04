<?php
/**
 * Selectize.js widget controller for tagging orders and customers.
 */
class Wfn_Tagger_Adminhtml_Widget_SelectizeController extends Wfn_Tagger_Controller_Base
{
    /**
     * Tag an entity.
     *
     * @return JSON string
     */
    public function addTagAction()
    {
        $request = $this->getRequest();
        $response = ['success' => false];
        $params = [
            'tag_name' => $request->getParam('tag_name'),
            'entity_id' => $request->getParam('entity_id'),
            'entity_type' => $request->getParam('entity_type'),
        ];

        try {
            $tag = Wfn_Tagger_Model_Resource_Tag::createTagAndRelation(
                $params['tag_name'],
                $params['entity_id'],
                $params['entity_type'],
                Mage::getSingleton('admin/session')->getUser()->getUserId()
            );

            $response['success'] = true;
            $response['tag'] = $tag->getName();
        } catch (Wfn_Tagger_Model_Validation_Exception $e) {
            $response['error_message'] = $this->__($e->getMessage());
        } catch (Exception $e) {
            $response['error_message'] = $this->__('Failed to add tag: ' . $e->getMessage());
        }

        return $this->jsonResponse($response);
    }

    /**
     * Untag an entity.
     */
    public function removeTagAction()
    {
        $request = $this->getRequest();
        $response = ['success' => false];
        $params = [
            'tag_name' => $request->getParam('tag_name'),
            'entity_id' => $request->getParam('entity_id'),
            'entity_type' => $request->getParam('entity_type'),
        ];

        try {
            $tag = Wfn_Tagger_Model_Resource_Tag::loadByName($params['tag_name']);

            if (!$tag->getId()) {
                $response['error_message'] = $this->__('Tag not found.');
                return $this->jsonResponse($response);
            }

            $affectedRows = Wfn_Tagger_Model_Resource_TagRelation::deleteByTagIdEntityIdAndEntityType(
                $tag->getId(),
                $params['entity_id'],
                $params['entity_type']
            );

            if ($affectedRows) {
                $response['success'] = true;
            } else {
                $response['error_message'] = 'Failed to remove tag.';
            }
        } catch (Exception $e) {
            $response['error_message'] = $this->__('Failed to remove tag: ' . $e->getMessage());
        }

        return $this->jsonResponse($response);
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('wfn_tagger/tag_orders_customers');
    }
}
