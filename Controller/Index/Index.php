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

namespace Mageprince\Faq\Controller\Index;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Magento\Theme\Block\Html\Title as HtmlTitle;
use Mageprince\Faq\Helper\Data;

class Index extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param Data $helper
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        Data $helper,
        PageFactory $resultPageFactory
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $pageMainTitle = $resultPage->getLayout()->getBlock('page.main.title');
        $pageTitle = $this->helper->getConfig('faqtab/general/page_title');

        if ($pageMainTitle && $pageMainTitle instanceof HtmlTitle) {
            $pageMainTitle->setPageTitle($pageTitle);
        }

        if (!$this->helper->getConfig('faqtab/general/enable')) {
            $pageMainTitle->setPageTitle('FAQ Disabled');
            return $resultPage;
        }

        $metaTitleConfig = $this->helper->getConfig('faqtab/seo/meta_title');
        $metaKeywordsConfig = $this->helper->getConfig('faqtab/seo/meta_keywords');
        $metaDescriptionConfig = $this->helper->getConfig('faqtab/seo/meta_description');

        $resultPage->getConfig()->getTitle()->set($metaTitleConfig);
        $resultPage->getConfig()->setDescription($metaDescriptionConfig);
        $resultPage->getConfig()->setKeywords($metaKeywordsConfig);

        return $resultPage;
    }
}
