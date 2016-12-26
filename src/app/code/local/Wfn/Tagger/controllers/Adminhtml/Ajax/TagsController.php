<?php
/**
 * Tag controller.
 */
class Wfn_Tagger_Adminhtml_Ajax_TagsController extends Mage_Adminhtml_Controller_Action
{
    /**
     * Proccess a request to tag an entity.
     *
     * @return JSON string
     */
    public function addTagAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        $response = ['success' => false];

        if (
            empty($params['tag']['name'])
            || empty($params['tag']['assigned_entity_id'])
            || empty($params['tag']['assigned_entity_type'])
        ) {
            $response['error_message'] = $this->__('Invalid tag data.');
            return $this->sendJsonResponse($response);
        }

        try {
            Wfn_Tagger_Model_Tag::createTagAndAssignEntity(
                $params['tag']['name'],
                $params['tag']['assigned_entity_id'],
                $params['tag']['assigned_entity_type'],
                Mage::getSingleton('admin/session')->getUser()->getUserId()
            );


            $response['success'] = true;

        } catch (Wfn_Tagger_Model_Validation_Exception $e) {
            $response['error_message'] = $this->__($e->getMessage());
        } catch (Exception $e) {
            Mage::log($e->getMessage());
            $response['error_message'] = $this->__('Whoops! Something went wrong. Please try again!');
        }

        return $this->sendJsonResponse($response);
    }

    /**
     * Proccess a request to untag an entity.
     */
    public function removeTagAction()
    {
        $request = $this->getRequest();
        $params = $request->getParams();
        $response = ['success' => false];

        if (
            empty($params['tag']['name'])
            || empty($params['tag']['assigned_entity_id'])
            || empty($params['tag']['assigned_entity_type'])
        ) {
            $response['error_message'] = $this->__('Invalid tag data.');
            return $this->sendJsonResponse($response);
        }

        try {
            $tag = Mage::getModel('wfn_tagger/tag')->loadByName($params['tag']['name']);
            if (!$tag->getId()) {
                $response['error_message'] = $this->__('Tag not found.');
                return $this->sendJsonResponse($response);
            }

            Wfn_Tagger_Model_Resource_TagRelation::deleteByTagIdEntityIdAndEntityType(
                $tag->getId(),
                $params['tag']['assigned_entity_id'],
                $params['tag']['assigned_entity_type']
            );

            $response['success'] = true;

        } catch (Exception $e) {
            Mage::log($e->getMessage());
            $response['error_message'] = $this->__('Whoops! Something went wrong. Please try again!');
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
}
