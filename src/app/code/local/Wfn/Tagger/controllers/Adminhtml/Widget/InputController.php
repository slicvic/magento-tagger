<?php
/**
 * Widget controller for tagging orders and customers.
 */
class Wfn_Tagger_Adminhtml_Widget_InputController extends Mage_Adminhtml_Controller_Action
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
            $tag = Wfn_Tagger_Model_Resource_TagRelation::addRelationByTagName(
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
            $response['error_message'] = $this->__('Failed to add tag. Error: ' . $e->getMessage());
        }

        return $this->sendJsonResponse($response);
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
                return $this->sendJsonResponse($response);
            }

            $affectedRows = Wfn_Tagger_Model_Resource_TagRelation::deleteByTagIdEntityIdAndEntityType(
                $tag->getId(),
                $params['entity_id'],
                $params['entity_type']
            );

            if ($affectedRows) {
                $response['success'] = true;
            } else {
                $response['error_message'] = 'Tag could not be removed.';
            }
        } catch (Exception $e) {
            $response['error_message'] = $this->__('Failed to remove tag. Error: ' . $e->getMessage());
        }

        return $this->sendJsonResponse($response);
    }

    /**
     * Send a JSON response.
     *
     * @param  array  $data
     */
    private function sendJsonResponse(array $data)
    {
        $this->getResponse()->setHeader('Content-type', 'application/json');
        $this->getResponse()->setBody(json_encode($data));
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('wfn_tagger/tag_orders_customers');
    }
}
