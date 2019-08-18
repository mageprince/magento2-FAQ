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

namespace Prince\Faq\Block\Index;

use Magento\Customer\Model\Session;

class Index extends \Magento\Framework\View\Element\Template
{
    private $faqCollectionFactory;

    private $faqGroupCollectionFactory;

    private $faqGroupFactory;

    private $storeManager;

    private $customerSession;
    
    private $templateProcessor;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Prince\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollectionFactory,
        \Prince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory $faqGroupCollectionFactory,
        \Prince\Faq\Model\FaqGroupFactory $faqGroupFactory,
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
}
