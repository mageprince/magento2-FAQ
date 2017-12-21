<?php


namespace Prince\Faq\Ui\Component\Listing\Column;

class FaqGroup implements \Magento\Framework\Option\ArrayInterface
{
    private $groupCollection;

    public function __construct(
        \Prince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory $groupCollection
    ) {
        $this->groupCollection = $groupCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $groupArr = [];
        $groups = $this->groupCollection->create();

        foreach ($groups as $group) {
            $groupArr[] = ['value' => $group->getFaqgroupId(), 'label' => __($group->getGroupname())];
        }

        return $groupArr;
    }
}
