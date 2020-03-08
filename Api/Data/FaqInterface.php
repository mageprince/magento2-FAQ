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

interface FaqInterface
{

    const TITLE = 'title';
    const SORTORDER = 'sortorder';
    const FAQ_ID = 'faq_id';
    const CONTENT = 'content';
    const STATUS = 'status';

    /**
     * Get faq_id
     * @return string|null
     */
    
    public function getFaqId();

    /**
     * Set faq_id
     * @param string $faq_id
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    
    public function setFaqId($faqId);

    /**
     * Get title
     * @return string|null
     */
    
    public function getTitle();

    /**
     * Set title
     * @param string $title
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    
    public function setTitle($title);

    /**
     * Get content
     * @return string|null
     */
    
    public function getContent();

    /**
     * Set content
     * @param string $content
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    
    public function setContent($content);

    /**
     * Get sortorder
     * @return string|null
     */
    
    public function getSortorder();

    /**
     * Set sortorder
     * @param string $sortorder
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    
    public function setSortorder($sortorder);

    /**
     * Get status
     * @return string|null
     */
    
    public function getStatus();

    /**
     * Set status
     * @param string $status
     * @return \Mageprince\Faq\Api\Data\FaqInterface
     */
    
    public function setStatus($status);
}
