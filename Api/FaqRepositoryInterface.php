<?php
/**
 * MagePrince
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the mageprince.com license that is
 * available through the world-wide-web at this URL:
 * https://mageprince.com/end-user-license-agreement
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MagePrince
 * @package     Mageprince_Faq
 * @copyright   Copyright (c) MagePrince (https://mageprince.com/)
 * @license     https://mageprince.com/end-user-license-agreement
 */

namespace Mageprince\Faq\Api;

interface FaqRepositoryInterface
{
    /**
     * Save Faq
     *
     * @param \Mageprince\Faq\Api\Data\FaqInterface $faq
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(\Mageprince\Faq\Api\Data\FaqInterface $faq);

    /**
     * Retrieve Faq
     *
     * @param int $faqId
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($faqId);

    /**
     * Retrieve Faq matching the specified criteria.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Mageprince\Faq\Api\Data\FaqSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Faq
     *
     * @param \Mageprince\Faq\Api\Data\FaqInterface $faq
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(\Mageprince\Faq\Api\Data\FaqInterface $faq);

    /**
     * Delete Faq by ID
     *
     * @param int $faqId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($faqId);
}
