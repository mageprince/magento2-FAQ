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

interface FaqGroupInterface
{
    const GROUPNAME = 'groupname';
    const FAQIDS = 'faqids';
    const FAQGROUP_ID = 'faqgroup_id';
    const ICON = 'icon';
    const SORTORDER = 'sortorder';
    const STATUS = 'status';

    /**
     * Get faqgroup_id
     * @return int
     */
    public function getFaqGroupId();

    /**
     * Set faqgroup_id
     * @param int $faqGroupId
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setFaqGroupId($faqGroupId);

    /**
     * Get groupname
     * @return int|null
     */
    public function getGroupName();

    /**
     * Set groupname
     * @param string $groupName
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setGroupName($groupName);

    /**
     * Get icon
     * @return string|null
     */
    public function getIcon();

    /**
     * Set icon
     * @param string $icon
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setIcon($icon);

    /**
     * Get faq ids
     * @return string|null
     */
    public function getFaqIds();

    /**
     * Set faq ids
     * @param string $faqIds
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setFaqIds($faqIds);

    /**
     * Get sort order
     * @return string|null
     */
    public function getSortOrder();

    /**
     * Set sort order
     * @param int $sortOrder
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setSortOrder($sortOrder);

    /**
     * Get status
     * @return string|null
     */
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setStatus($status);
}
