<?php

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
