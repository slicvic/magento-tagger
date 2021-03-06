<?php
/**
 * Block for managing tags via CRUD UI.
 */
class Slicvic_Tagger_Block_Adminhtml_Tags_All extends Mage_Adminhtml_Block_Template
{
    /**
     * Get list of all admin users.
     *
     * @return Mage_Admin_Model_Resource_User_Collection
     */
    public function getAllAdminUsers()
    {
        return Mage::getModel('admin/user')
            ->getCollection()
            ->load();
    }

    /**
     * Get list of all tags.
     *
     * @return Slicvic_Tagger_Model_Resource_Tag_Collection
     */
    public function getAllTags()
    {
        return Mage::getModel('slicvic_tagger/tag')
            ->getCollection()
            ->setOrder('created_at', 'DESC')
            ->load();
    }
}