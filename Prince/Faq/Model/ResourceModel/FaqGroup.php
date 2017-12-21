<?php


namespace Prince\Faq\Model\ResourceModel;

class FaqGroup extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init('prince_faqgroup', 'faqgroup_id');
    }
}
