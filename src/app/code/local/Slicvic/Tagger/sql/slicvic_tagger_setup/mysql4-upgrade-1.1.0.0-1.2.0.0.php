<?php
/**
 * This upgrade script removes the 'user_id' field from slicvic_tagger_tag table.
 */

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->dropColumn($installer->getTable('slicvic_tagger/tag'), 'user_id');

$installer->getConnection()->dropForeignKey(
    $installer->getTable('slicvic_tagger/tag'),
    $installer->getFkName('slicvic_tagger/tag', 'user_id', 'admin/user', 'user_id')
);

$installer->endSetup();
