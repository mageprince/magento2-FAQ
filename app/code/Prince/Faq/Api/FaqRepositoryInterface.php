<?php


namespace Prince\Faq\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqRepositoryInterface
{
    
    /**
     * Save Faq
     * @param \Prince\Faq\Api\Data\FaqInterface $faq
     * @return \Prince\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(\Prince\Faq\Api\Data\FaqInterface $faq);

    /**
     * Retrieve Faq
     * @param string $faqId
     * @return \Prince\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($faqId);

    /**
     * Retrieve Faq matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Prince\Faq\Api\Data\FaqSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Faq
     * @param \Prince\Faq\Api\Data\FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(\Prince\Faq\Api\Data\FaqInterface $faq);

    /**
     * Delete Faq by ID
     * @param string $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($faqId);
}
