<?php
/**
 * This upgrade script adds a 'user_id' field to wfn_tagger_tag table
 * to associate tags with admin users.
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('wfn_tagger/tag'), 'user_id', [
        'type' => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'after' => 'name',
        'nullable' => true,
        'unsigned' => true,
        'comment' => 'Associated admin user ID'
        ]);

$installer->getConnection()->addForeignKey(
    $installer->getFkName('wfn_tagger/tag', 'user_id', 'admin/user', 'user_id'),
    $installer->getTable('wfn_tagger/tag'),
    'user_id',
    $installer->getTable('admin/user'),
    'user_id',
    Varien_Db_Ddl_Table::ACTION_NO_ACTION,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

$installer->endSetup();