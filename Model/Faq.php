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
use Mageprince\Faq\Api\Data\FaqInterface;
use Mageprince\Faq\Model\ResourceModel\Faq as FaqModel;

class Faq extends AbstractModel implements FaqInterface
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init(FaqModel::class);
    }

    /**
     * @inheridoc
     */
    public function getFaqId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * @inheridoc
     */
    public function setFaqId($faqId)
    {
        return $this->setData(self::FAQ_ID, $faqId);
    }

    /**
     * @inheridoc
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * @inheridoc
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * @inheridoc
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * @inheridoc
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
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
