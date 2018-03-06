<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Faq
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

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
            'icon',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'icon'
        );

        $table_prince_faqgroup->addColumn(
            'storeview',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'storeview'
        );
        
        $table_prince_faqgroup->addColumn(
            'customer_group',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'customer_group'
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
            'storeview',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'storeview'
        );
        
        $table_prince_faq->addColumn(
            'customer_group',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            null,
            [],
            'customer_group'
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
