<?php


namespace Prince\Faq\Api\Data;

interface FaqGroupSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get FaqGroup list.
     * @return \Prince\Faq\Api\Data\FaqGroupInterface[]
     */
    
    public function getItems();

    /**
     * Set groupname list.
     * @param \Prince\Faq\Api\Data\FaqGroupInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
