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

namespace Prince\Faq\Model;

use Prince\Faq\Api\Data\FaqGroupInterface;

class FaqGroup extends \Magento\Framework\Model\AbstractModel implements FaqGroupInterface
{

    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init('Prince\Faq\Model\ResourceModel\FaqGroup');
    }

    /**
     * Get faqgroup_id
     * @return string
     */
    public function getFaqgroupId()
    {
        return $this->getData(self::FAQGROUP_ID);
    }

    /**
     * Set faqgroup_id
     * @param string $faqgroupId
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setFaqgroupId($faqgroupId)
    {
        return $this->setData(self::FAQGROUP_ID, $faqgroupId);
    }

    /**
     * Get groupname
     * @return string
     */
    public function getGroupname()
    {
        return $this->getData(self::GROUPNAME);
    }

    /**
     * Set groupname
     * @param string $groupname
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setGroupname($groupname)
    {
        return $this->setData(self::GROUPNAME, $groupname);
    }

    /**
     * Get groupcode
     * @return string
     */
    public function getGroupcode()
    {
        return $this->getData(self::GROUPCODE);
    }

    /**
     * Set groupcode
     * @param string $groupcode
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setGroupcode($groupcode)
    {
        return $this->setData(self::GROUPCODE, $groupcode);
    }

    /**
     * Get icon
     * @return string
     */
    public function getIcon()
    {
        return $this->getData(self::ICON);
    }

    /**
     * Set icon
     * @param string $icon
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setIcon($icon)
    {
        return $this->setData(self::ICON, $icon);
    }

    /**
     * Get width
     * @return string
     */
    public function getWidth()
    {
        return $this->getData(self::WIDTH);
    }

    /**
     * Set width
     * @param string $width
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setWidth($width)
    {
        return $this->setData(self::WIDTH, $width);
    }

    /**
     * Get faqids
     * @return string
     */
    public function getFaqids()
    {
        return $this->getData(self::FAQIDS);
    }

    /**
     * Set faqids
     * @param string $faqids
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setFaqids($faqids)
    {
        return $this->setData(self::FAQIDS, $faqids);
    }

    /**
     * Get status
     * @return string
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status
     * @param string $status
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
