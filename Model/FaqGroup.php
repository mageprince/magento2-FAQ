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

namespace Mageprince\Faq\Model;

use Magento\Framework\Model\AbstractModel;
use Mageprince\Faq\Api\Data\FaqGroupInterface;
use Mageprince\Faq\Model\ResourceModel\FaqGroup as FaqGroupResourceModel;

class FaqGroup extends AbstractModel implements FaqGroupInterface
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(FaqGroupResourceModel::class);
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Mageprince\Faq\Api\Data\FaqGroupInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
