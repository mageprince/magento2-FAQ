<?php

/**
 * MagePrince
 * Copyright (C) 2020 Mageprince <info@mageprince.com>
 *
 * @package Mageprince_Faq
 * @copyright Copyright (c) 2020 Mageprince (http://www.mageprince.com/)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince <info@mageprince.com>
 */

namespace Mageprince\Faq\Setup;

use Magento\Framework\DB\Ddl\Table as DdlTable;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        if (version_compare($context->getVersion(), '2.0.7', '<')) {
            $this->addDateColumns($setup);
        }
    }

    /**
     * Add date columns
     *
     * @param SchemaSetupInterface $setup
     */
    public function addDateColumns($setup)
    {
        $installer = $setup;
        $installer->startSetup();

        $faqTable = $setup->getTable('prince_faq');

        if ($setup->getConnection()->isTableExists($faqTable)) {
            $installer->getConnection()
                ->addColumn(
                    $faqTable,
                    'created_at',
                    [
                        'type'     => DdlTable::TYPE_TIMESTAMP,
                        'nullable' => false,
                        'default'  => DdlTable::TIMESTAMP_INIT,
                        'comment'  => 'Faq Created Date Time'
                    ]
                );
            $installer->getConnection()
                ->addColumn(
                    $faqTable,
                    'updated_at',
                    [
                        'type'     => DdlTable::TYPE_TIMESTAMP,
                        'nullable' => false,
                        'default'  => DdlTable::TIMESTAMP_INIT_UPDATE,
                        'comment'  => 'Faq Modified Date Time'
                    ]
                );
        }

        $faqGroupTable = $setup->getTable('prince_faqgroup');

        if ($setup->getConnection()->isTableExists($faqGroupTable)) {
            $installer->getConnection()
                ->addColumn(
                    $faqGroupTable,
                    'created_at',
                    [
                        'type'     => DdlTable::TYPE_TIMESTAMP,
                        'nullable' => false,
                        'default'  => DdlTable::TIMESTAMP_INIT,
                        'comment'  => 'Faq Group Created Date Time'
                    ]
                );
            $installer->getConnection()->addColumn(
                $faqGroupTable,
                'updated_at',
                [
                        'type'     => DdlTable::TYPE_TIMESTAMP,
                        'nullable' => false,
                        'default'  => DdlTable::TIMESTAMP_INIT_UPDATE,
                        'comment'  => 'Faq Group Modified Date Time'
                    ]
            );
        }
    }
}
