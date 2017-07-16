<?php


namespace Prince\Faq\Api\Data;

interface FaqSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{
    
    /**
     * Get Faq list.
     * @return \Prince\Faq\Api\Data\FaqInterface[]
     */
    
    public function getItems();

    /**
     * Set title list.
     * @param \Prince\Faq\Api\Data\FaqInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
