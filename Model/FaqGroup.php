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

namespace Mageprince\Faq\Model;

use Magento\Framework\Model\AbstractModel;
use Mageprince\Faq\Api\Data\FaqGroupInterface;
use Mageprince\Faq\Model\ResourceModel\FaqGroup as FaqGroupResourceModel;

class FaqGroup extends AbstractModel implements FaqGroupInterface
{
    /**
     * Initialize resource model.
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(FaqGroupResourceModel::class);
    }

    /**
     * Get FAQ group id.
     *
     * @return int
     */
    public function getFaqGroupId()
    {
        return $this->getData(self::FAQGROUP_ID);
    }

    /**
     * Set FAQ group id.
     *
     * @param int $faqGroupId
     * @return FaqGroupInterface
     */
    public function setFaqGroupId($faqGroupId)
    {
        return $this->setData(self::FAQGROUP_ID, $faqGroupId);
    }

    /**
     * Get group name.
     *
     * @return string|null
     */
    public function getGroupName()
    {
        return $this->getData(self::GROUPNAME);
    }

    /**
     * Set group name.
     *
     * @param string $groupName
     * @return FaqGroupInterface
     */
    public function setGroupName($groupName)
    {
        return $this->setData(self::GROUPNAME, $groupName);
    }

    /**
     * Get icon.
     *
     * @return string|null
     */
    public function getIcon()
    {
        return $this->getData(self::ICON);
    }

    /**
     * Set icon.
     *
     * @param string $icon
     * @return FaqGroupInterface
     */
    public function setIcon($icon)
    {
        return $this->setData(self::ICON, $icon);
    }

    /**
     * Get FAQ ids.
     *
     * @return string|null
     */
    public function getFaqIds()
    {
        return $this->getData(self::FAQIDS);
    }

    /**
     * Set FAQ ids.
     *
     * @param string $faqIds
     * @return FaqGroupInterface
     */
    public function setFaqIds($faqIds)
    {
        return $this->setData(self::FAQIDS, $faqIds);
    }

    /**
     * Get sort order.
     *
     * @return string|null
     */
    public function getSortOrder()
    {
        return $this->getData(self::SORTORDER);
    }

    /**
     * Set sort order.
     *
     * @param string $sortOrder
     * @return FaqGroupInterface
     */
    public function setSortOrder($sortOrder)
    {
        return $this->setData(self::SORTORDER, $sortOrder);
    }

    /**
     * Get status.
     *
     * @return string|null
     */
    public function getStatus()
    {
        return $this->getData(self::STATUS);
    }

    /**
     * Set status.
     *
     * @param string $status
     * @return FaqGroupInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
