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

namespace Prince\Faq\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    private $resultPageFactory;

    /**
     * @var \Prince\Faq\Helper\Data
     */
    protected $helper;

    /**
     * Index constructor.
     * @param \Magento\Framework\App\Action\Context $context
     * @param \Prince\Faq\Helper\Data $helper
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Prince\Faq\Helper\Data $helper,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title');
        $pageTitle = $this->helper->getConfig('faqtab/general/page_title');

        if ($pageMainTitle && $pageMainTitle instanceof \Magento\Theme\Block\Html\Title) {
            $pageMainTitle->setPageTitle($pageTitle);
        }

        if(!$this->helper->getConfig('faqtab/general/enable')) {
            $pageMainTitle->setPageTitle('FAQ Disabled');
            return $resultPage;
        }

        $metaTitleConfig = $this->helper->getConfig('faqtab/general/meta_title');
        $metaKeywordsConfig = $this->helper->getConfig('faqtab/general/meta_keywords');
        $metaDescriptionConfig = $this->helper->getConfig('faqtab/general/meta_description');

        $resultPage->getConfig()->getTitle()->set($metaTitleConfig);
        $resultPage->getConfig()->setDescription($metaKeywordsConfig);
        $resultPage->getConfig()->setKeywords($metaDescriptionConfig);

        return $resultPage;
    }
}
