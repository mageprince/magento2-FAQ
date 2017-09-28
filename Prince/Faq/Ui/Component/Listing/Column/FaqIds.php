<?php


namespace Prince\Faq\Ui\Component\Listing\Column;

class FaqIds implements \Magento\Framework\Option\ArrayInterface
{
    private $faqCollection;

    public function __construct(
        \Prince\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollection
    ) {
        $this->faqCollection = $faqCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $faqArr = [];
        $faqs = $this->faqCollection->create();

        foreach ($faqs as $faq) {
            $faqArr[] = ['value' => $faq->getFaqId(), 'label' => __($faq->getTitle())];
        }

        return $faqArr;
    }
}
