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
     * @return \Prince\Faq\Api\Data\FaqInterface
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
     * @return \Prince\Faq\Api\Data\FaqInterface
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
     * @return \Prince\Faq\Api\Data\FaqInterface
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
     * @return \Prince\Faq\Api\Data\FaqInterface
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
     * @return \Prince\Faq\Api\Data\FaqInterface
     */
    
    public function setStatus($status);
}
