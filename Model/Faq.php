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
     * Get faq_id
     * @return string
     */
    public function getFaqId()
    {
        return $this->getData(self::FAQ_ID);
    }

    /**
     * Set faq_id
     * @param string $faqId
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    public function setFaqId($faqId)
    {
        return $this->setData(self::FAQ_ID, $faqId);
    }

    /**
     * Get title
     * @return string
     */
    public function getTitle()
    {
        return $this->getData(self::TITLE);
    }

    /**
     * Set title
     * @param string $title
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    public function setTitle($title)
    {
        return $this->setData(self::TITLE, $title);
    }

    /**
     * Get content
     * @return string
     */
    public function getContent()
    {
        return $this->getData(self::CONTENT);
    }

    /**
     * Set content
     * @param string $content
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    public function setContent($content)
    {
        return $this->setData(self::CONTENT, $content);
    }

    /**
     * Get sortorder
     * @return string
     */
    public function getSortorder()
    {
        return $this->getData(self::SORTORDER);
    }

    /**
     * Set sortorder
     * @param string $sortorder
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    public function setSortorder($sortorder)
    {
        return $this->setData(self::SORTORDER, $sortorder);
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
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }
}
