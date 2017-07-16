<?php


namespace Prince\Faq\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class InstallSchema implements InstallSchemaInterface
{

    /**
     * {@inheritdoc}
     */
    public function install(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $installer = $setup;
        $installer->startSetup();

        $table_prince_faqgroup = $setup->getConnection()->newTable($setup->getTable('prince_faqgroup'));

        $table_prince_faqgroup->addColumn(
            'faqgroup_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );
                
        $table_prince_faqgroup->addColumn(
            'groupname',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'groupname'
        );
        
        $table_prince_faqgroup->addColumn(
            'groupcode',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'groupcode'
        );
           
        $table_prince_faqgroup->addColumn(
            'icon',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'icon'
        );
        
        $table_prince_faqgroup->addColumn(
            'width',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'width'
        );

        $table_prince_faqgroup->addColumn(
            'sortorder',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'sortorder'
        );
      
        $table_prince_faqgroup->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'status'
        );
        
        $table_prince_faq = $setup->getConnection()->newTable($setup->getTable('prince_faq'));
 
        $table_prince_faq->addColumn(
            'faq_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'nullable' => false,
                'primary' => true,
                'unsigned' => true,
            ],
            'Entity ID'
        );
        
        $table_prince_faq->addColumn(
            'title',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'title'
        );
        
        $table_prince_faq->addColumn(
            'content',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'content'
        );
        
        $table_prince_faq->addColumn(
            'group',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'group'
        );
        
        $table_prince_faq->addColumn(
            'sortorder',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            [],
            'sortorder'
        );
        
        $table_prince_faq->addColumn(
            'status',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            [],
            'status'
        );
        
        $setup->getConnection()->createTable($table_prince_faq);
        $setup->getConnection()->createTable($table_prince_faqgroup);
        $setup->endSetup();
    }
}
