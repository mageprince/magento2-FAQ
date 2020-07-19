<?php

/**
 * MagePrince
 * Copyright (C) 2020 Mageprince <info@mageprince.com>
 *
 * @package Mageprince_Faq
 * @copyright Copyright (c) 2020 Mageprince (http://www.mageprince.com/)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince <info@mageprince.com>
 */

namespace Mageprince\Faq\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

interface FaqGroupSearchResultsInterface extends SearchResultsInterface
{

    /**
     * Get FaqGroup list.
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface[]
     */
    
    public function getItems();

    /**
     * Set groupname list.
     * @param \Mageprince\Faq\Api\Data\FaqGroupInterface[] $items
     * @return $this
     */
    
    public function setItems(array $items);
}
