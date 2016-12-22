<?php
/**
 * This install script will create the following database tables
 * for storing tags and their related entities.
 *
 * - wfn_tagger_tag
 * - wfn_tagger_tag_relation
 */

 /* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table 'wfn_tagger_tag' for storing tags.
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('wfn_tagger/tag'))
    ->addColumn('tag_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'primary'  => true,
        'identity' => true, // Auto increment
        'unsigned' => true,
        'nullable' => false,
        ])
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255, [
        'nullable' => false,
        ])
    ->addIndex( // Name field should be unique
        $installer->getIdxName('wfn_tagger/tag', ['name'], Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
        ['name'],
        ['type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE]);

$installer->getConnection()->createTable($table);

/**
 * Create table 'wfn_tagger_tag_relation' for storing many-to-many
 * relationships.
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('wfn_tagger/relation'))
    ->addColumn('tag_relation_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'primary'  => true,
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        ])
    ->addColumn('tag_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'unsigned' => true,
        'nullable' => false,
        'default'  => 0,
        ])
    ->addColumn('entity_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'unsigned' => true,
        'nullable' => false,
        ])
    ->addColumn('entity_type', Varien_Db_Ddl_Table::TYPE_VARCHAR, 8, [
        'nullable' => false,
        ])
    ->addColumn('created_uid', Varien_Db_Ddl_Table::TYPE_INTEGER, null, [
        'unsigned' => true,
        'nullable' => false,
        ], 'Admin user ID who added record')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null)
    ->addIndex($installer->getIdxName('wfn_tagger/relation', ['tag_id']), ['tag_id'])
    ->addIndex($installer->getIdxName('wfn_tagger/relation', ['entity_id']), ['entity_id'])
    ->addIndex($installer->getIdxName('wfn_tagger/relation', ['entity_type']), ['entity_type'])
    ->addIndex( // Tag ID, entity ID and entity type combination should be unique
        $installer->getIdxName('wfn_tagger/relation', ['tag_id', 'entity_id', 'entity_type'], Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE),
        ['tag_id', 'entity_id', 'entity_type'],
        ['type' => Varien_Db_Adapter_Interface::INDEX_TYPE_UNIQUE])
    ->addForeignKey(
        $installer->getFkName('wfn_tagger/relation', 'tag_id', 'wfn_tagger/tag', 'tag_id'),
        'tag_id',
        $installer->getTable('wfn_tagger/tag'),
        'tag_id',
        Varien_Db_Ddl_Table::ACTION_RESTRICT,
        Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey(
        $installer->getFkName('wfn_tagger/relation', 'created_uid', 'admin/user', 'user_id'),
        'created_uid',
        $installer->getTable('admin/user'),
        'user_id',
        Varien_Db_Ddl_Table::ACTION_NO_ACTION,
        Varien_Db_Ddl_Table::ACTION_CASCADE);

$installer->getConnection()->createTable($table);

$installer->endSetup();
