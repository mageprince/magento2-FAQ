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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setStatus($status);
}
