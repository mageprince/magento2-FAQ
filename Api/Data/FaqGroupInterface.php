<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Faq
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Prince\Faq\Api\Data;

interface FaqGroupInterface
{

    const GROUPNAME = 'groupname';
    const FAQIDS = 'faqids';
    const FAQGROUP_ID = 'faqgroup_id';
    const ICON = 'icon';
    const STATUS = 'status';
    const GROUPCODE = 'groupcode';
    const WIDTH = 'width';

    /**
     * Get faqgroup_id
     * @return string|null
     */
    
    public function getFaqgroupId();

    /**
     * Set faqgroup_id
     * @param string $faqgroup_id
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setFaqgroupId($faqgroupId);

    /**
     * Get groupname
     * @return string|null
     */
    
    public function getGroupname();

    /**
     * Set groupname
     * @param string $groupname
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setGroupname($groupname);

    /**
     * Get groupcode
     * @return string|null
     */
    
    public function getGroupcode();

    /**
     * Set groupcode
     * @param string $groupcode
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setGroupcode($groupcode);

    /**
     * Get icon
     * @return string|null
     */
    
    public function getIcon();

    /**
     * Set icon
     * @param string $icon
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setIcon($icon);

    /**
     * Get width
     * @return string|null
     */
    
    public function getWidth();

    /**
     * Set width
     * @param string $width
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setWidth($width);

    /**
     * Get faqids
     * @return string|null
     */
    
    public function getFaqids();

    /**
     * Set faqids
     * @param string $faqids
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setFaqids($faqids);

    /**
     * Get status
     * @return string|null
     */
    
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setStatus($status);
}
