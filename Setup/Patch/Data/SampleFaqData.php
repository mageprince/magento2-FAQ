<?php
namespace Mageprince\Faq\Setup\Patch\Data;

use Magento\Eav\Setup\EavSetupFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\Patch\DataPatchInterface;

class SampleFaqData implements DataPatchInterface
{
    /**
     * @var ModuleDataSetupInterface
     */
    protected $moduleDataSetup;

    /**
     * SampleFaqData constructor.
     *
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        ModuleDataSetupInterface $moduleDataSetup
    ) {
        $this->moduleDataSetup = $moduleDataSetup;
    }

    /**
     * @inheritdoc
     */
    public function apply()
    {
        $this->moduleDataSetup->getConnection()->startSetup();
        $setup = $this->moduleDataSetup;

        $faqGroupData = [
            'groupname' => 'General',
            'sortorder' => '1',
            'storeview' => '1',
            'customer_group' => '0,1,2,3,4',
            'status' => '1'
        ];

        $faqData = [
            'title' => 'This is a test FAQ question',
            'content' => 'This is a test FAQ answer',
            'group' => '1',
            'storeview' => '1',
            'customer_group' => '0,1,2,3,4',
            'sortorder' => '0',
            'status' => '1'
        ];

        $faqGroupTable = $setup->getTable('prince_faqgroup');
        $faqTable = $setup->getTable('prince_faq');

        $setup->getConnection()->insert($faqGroupTable, $faqGroupData);
        $setup->getConnection()->insert($faqTable, $faqData);
        $this->moduleDataSetup->getConnection()->endSetup();
    }

    /**
     * @inheritdoc
     */
    public static function getDependencies()
    {
        return [];
    }

    /**
     * @inheritdoc
     */
    public function getAliases()
    {
        return [];
    }
}
