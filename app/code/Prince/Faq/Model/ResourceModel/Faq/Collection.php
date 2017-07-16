<?php


namespace Prince\Faq\Model\ResourceModel\Faq;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

    public $_idFieldName = 'faq_id';
    
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Prince\Faq\Model\Faq',
            'Prince\Faq\Model\ResourceModel\Faq'
        );
    }
}
