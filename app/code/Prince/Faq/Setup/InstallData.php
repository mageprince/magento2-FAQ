<?php

namespace Prince\Faq\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->getConnection()->query("INSERT INTO prince_faqgroup (`groupname`, `sortorder`, `status`) VALUES('General', '0', '1')");
        $setup->getConnection()->query("INSERT INTO prince_faq (`title`, `content`, `group`, `sortorder`, `status`) VALUES ('This is test FAQ question', 'This is test FAQ answer', '1', '0', '1')");
    }
}
