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

namespace Mageprince\Faq\Block\Index;

use Magento\Customer\Model\Session;

class Index extends \Magento\Framework\View\Element\Template
{
    const CONFIG_PATH_IS_ENABLE = 'faqtab/general/enable';

    const CONFIG_PATH_IS_SHOW_GROUP = 'faqtab/design/showgroup';

    const CONFIG_PATH_IS_SHOW_GROUP_TITLE = 'faqtab/design/showgrouptitle';

    const CONFIG_PATH_PAGE_TYPE = 'faqtab/design/page_type';

    private $faqCollectionFactory;

    private $faqGroupCollectionFactory;

    private $faqGroupFactory;

    private $storeManager;

    private $customerSession;
    
    private $templateProcessor;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        \Mageprince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory $faqGroupCollectionFactory,
        \Mageprince\Faq\Model\FaqGroupFactory $faqGroupFactory,
        Session $customerSession,
        \Zend_Filter_Interface $templateProcessor
    ) {
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->faqGroupCollectionFactory = $faqGroupCollectionFactory;
        $this->faqGroupFactory = $faqGroupFactory;
        $this->storeManager = $context->getStoreManager();
        $this->customerSession = $customerSession;
        $this->templateProcessor = $templateProcessor;
        $this->scopeConfig = $context->getScopeConfig();
        parent::__construct($context);
    }

    public function getFaqCollection($group)
    {
        if ($this->getGroupId()) {
            $group = $this->getGroupId();
        }
        $faqCollection = $this->faqCollectionFactory->create();
        $faqCollection->addFieldToFilter('group', ['like' => '%'.$group.'%']);
        $faqCollection->addFieldToFilter('status', 1);
        $faqCollection->addFieldToFilter(
            'customer_group',
            [
                ['null' => true],
                ['finset' => $this->getCurrentCustomer()]
            ]
        );
        $faqCollection->addFieldToFilter(
            'storeview',
            [
                ['eq' => 0],
                ['finset' => $this->getCurrentStore()]
            ]
        );
        $faqCollection->setOrder('sortorder', 'ASC');
        return $faqCollection;
    }

    public function getFaqGroupCollection()
    {
        $faqGroupCollection = $this->faqGroupCollectionFactory->create();
        $faqGroupCollection->addFieldToFilter('status', 1);
        $faqGroupCollection->addFieldToFilter(
            'customer_group',
            [
                ['null' => true],
                ['finset' => $this->getCurrentCustomer()]
            ]
        );
        $faqGroupCollection->addFieldToFilter(
            'storeview',
            [
                ['eq' => 0],
                ['finset' => $this->getCurrentStore()]
            ]
        );
        $faqGroupCollection->setOrder('sortorder', 'ASC');
        return $faqGroupCollection;
    }

    public function getGroupById($groupId)
    {
        $faqGroup = $this->faqGroupFactory->create();
        $faqGroup->load($groupId);
        return $faqGroup;
    }

    public function filterOutputHtml($string)
    {
        return $this->templateProcessor->filter($string);
    }

    public function getImageUrl($icon)
    {
        $mediaUrl = $this->storeManager
                         ->getStore()
                         ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $mediaUrl.'faq/tmp/icon/'.$icon;
        return $imageUrl;
    }

    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    public function getCurrentCustomer()
    {
        return $this->customerSession->getCustomer()->getGroupId();
    }

    public function getCurrentStore()
    {
        return $this->storeManager->getStore()->getId();
    }

    public function isEnable()
    {
        return $this->getConfig(self::CONFIG_PATH_IS_ENABLE);
    }

    public function isShowGroup()
    {
        if ($this->getShowGroup() != null) {
            return $this->checkBlockData($this->getShowGroup());
        } else {
            return $this->getConfig(self::CONFIG_PATH_IS_SHOW_GROUP);
        }
    }

    public function isShowGroupTitle()
    {
        if ($this->getShowGroupTitle() != null) {
            return $this->checkBlockData($this->getShowGroupTitle());
        } else {
            return $this->getConfig(self::CONFIG_PATH_IS_SHOW_GROUP_TITLE);
        }
    }

    private function checkBlockData($data)
    {
        if ($data == '1') {
            return true;
        } else if ($data == '0') {
            return false;
        }
    }

    public function getPageTypeAction()
    {
        if ($this->getPageType() == 'ajax') {
            $pageType = 'ajax';
        } else if ($this->getPageType() == 'scroll') {
            $pageType = 'scroll';
        } else {
            $pageType = $this->getConfig(self::CONFIG_PATH_PAGE_TYPE);
        }

        return $pageType;
    }
}
