<?php


namespace Prince\Faq\Model\ResourceModel\FaqGroup;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public $_idFieldName = 'faqgroup_id';
   
    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            'Prince\Faq\Model\FaqGroup',
            'Prince\Faq\Model\ResourceModel\FaqGroup'
        );
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('faqgroup_id', 'groupname');
    }
}
