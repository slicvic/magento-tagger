<?php
/**
 * Widget AJAX controller.
 */
class Wfn_Tagger_Adminhtml_Widget_AjaxController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Tag an entity.
     *
     * @return JSON string
     */
    public function addTagAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        $response = [
            'success' => false
        ];

        if (empty($params['tag_name'])
            || empty($params['entity_id'])
            || empty($params['entity_type'])
        ) {
            $response['error_message'] = $this->__('Invalid parameters.');
            return $this->sendJsonResponse($response);
        }

        try {
            $tag = Wfn_Tagger_Model_Resource_TagRelation::addRelationByTagName(
                $params['tag_name'],
                $params['entity_id'],
                $params['entity_type'],
                Mage::getSingleton('admin/session')->getUser()->getUserId()
            );

            $response['success'] = true;
            $response['tag'] = $tag->name;
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
        $params = $request->getParams();
        $response = [
            'success' => false
        ];

        if (empty($params['tag_name'])
            || empty($params['entity_id'])
            || empty($params['entity_type'])
        ) {
            $response['error_message'] = $this->__('Invalid parameters.');
            return $this->sendJsonResponse($response);
        }

        try {
            $tag = Wfn_Tagger_Model_Resource_Tag::loadByName($params['tag_name']);

            if (!$tag->getId()) {
                $response['error_message'] = $this->__('Tag not found.');
                return $this->sendJsonResponse($response);
            }

            Wfn_Tagger_Model_Resource_TagRelation::deleteByTagIdEntityIdAndEntityType(
                $tag->getId(),
                $params['entity_id'],
                $params['entity_type']
            );

            $response['success'] = true;
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
