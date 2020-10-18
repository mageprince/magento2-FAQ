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
     * @inheridoc
     */
    public function getFaqGroupId()
    {
        return $this->getData(self::FAQGROUP_ID);
    }

    /**
     * @inheridoc
     */
    public function setFaqGroupId($faqGroupId)
    {
        return $this->setData(self::FAQGROUP_ID, $faqGroupId);
    }

    /**
     * @inheridoc
     */
    public function getGroupName()
    {
        return $this->getData(self::GROUPNAME);
    }

    /**
     * @inheridoc
     */
    public function setGroupName($groupName)
    {
        return $this->setData(self::GROUPNAME, $groupName);
    }

    /**
     * @inheridoc
     */
    public function getIcon()
    {
        return $this->getData(self::ICON);
    }

    /**
     * @inheridoc
     */
    public function setIcon($icon)
    {
        return $this->setData(self::ICON, $icon);
    }

    /**
     * @inheridoc
     */
    public function getFaqIds()
    {
        return $this->getData(self::FAQIDS);
    }

    /**
     * @inheridoc
     */
    public function setFaqIds($faqIds)
    {
        return $this->setData(self::FAQIDS, $faqIds);
    }

    /**
     * @inheridoc
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORTORDER);
    }

    /**
     * @inheridoc
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORTORDER, $sortOrder);
    }

    /**
     * @inheridoc
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * @inheridoc
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
