<?php


namespace Prince\Faq\Api\Data;

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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
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
     * @return \Prince\Faq\Api\Data\FaqGroupInterface
     */
    
    public function setStatus($status);
}
