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

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
    	$table_prince_faqgroup = $setup->getTable('prince_faqgroup');
    	$table_prince_faq = $setup->getTable('prince_faq');
    	
        $setup->getConnection()->query("INSERT INTO $table_prince_faqgroup (`groupname`, `sortorder`, `storeview`, `customer_group`, `status`) VALUES('General', '1', '0,1,2,3,4', '0,1,2,3,4', '1')");
        $setup->getConnection()->query("INSERT INTO $table_prince_faq (`title`, `content`, `group`, `storeview`, `customer_group`, `sortorder`, `status`) VALUES ('This is test FAQ question', 'This is test FAQ answer', '1', '1', '0,1,2,3,4', '0', '1')");
    }
}
