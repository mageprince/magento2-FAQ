<?php

/**
 * MagePrince
 * Copyright (C) 2020 Mageprince <info@mageprince.com>
 *
 * @package Prince_Faq
 * @copyright Copyright (c) 2020 Mageprince (http://www.mageprince.com/)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince <info@mageprince.com>
 */

namespace Prince\Faq\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface FaqGroupRepositoryInterface
{

    /**
     * Save FaqGroup
     * @param \Prince\Faq\Api\Data\FaqGroupInterface $faqGroup
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function save(
        \Prince\Faq\Api\Data\FaqGroupInterface $faqGroup
    );

    /**
     * Retrieve FaqGroup
     * @param string $faqgroupId
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getById($faqgroupId);

    /**
     * Retrieve FaqGroup matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Prince\Faq\Api\Data\FaqGroupSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete FaqGroup
     * @param \Prince\Faq\Api\Data\FaqGroupInterface $faqGroup
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function delete(
        \Prince\Faq\Api\Data\FaqGroupInterface $faqGroup
    );

    /**
     * Delete FaqGroup by ID
     * @param string $faqgroupId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    
    public function deleteById($faqgroupId);
}
