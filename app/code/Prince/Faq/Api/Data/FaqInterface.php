<?php


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
