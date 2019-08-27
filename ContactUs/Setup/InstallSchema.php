<?php
/**
 * Class InstallSchema
 */
namespace Smile\ContactUs\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

/**
 * Class InstallSchema
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * Install tabel smile_contact us_appeal
     *
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('smile_contact_us_appeal')
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
            'Appeal id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            255,
            [],
            'Name'
        )->addColumn(
            'email',
            Table::TYPE_TEXT,
            255,
            [],
            'Email'
        )->addColumn(
            'telephone',
            Table::TYPE_TEXT,
            255,
            [],
            'Phone Number'
        )->addColumn(
            'comment',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Appeal'
        )->addColumn(
            'created_at',
            Table::TYPE_TIMESTAMP,
            null,
            [
                'nullable' => false,
                'default' => Table::TIMESTAMP_INIT
            ],
            'Created at'
        )->addColumn(
            'status',
            Table::TYPE_SMALLINT,
            null,
            [
                'nullable' => false,
                'default' => '0'
            ],
            'Status'
        )->addColumn(
            'answer',
            Table::TYPE_TEXT,
            '2M',
            [],
            'Answer'
        )->setComment(
            'Smile Contact Us Appeal Table'
        );

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
