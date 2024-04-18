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

namespace Mageprince\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface FaqSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get Faq list.
     *
     * @return \Mageprince\Faq\Api\Data\FaqInterface[]
     */
    public function getItems();

    /**
     * Set title list.
     *
     * @param \Mageprince\Faq\Api\Data\FaqInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
