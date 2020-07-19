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
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\View\Result\PageFactory;
use Mageprince\Faq\Block\Index\Index as FaqBlock;
use Mageprince\Faq\Helper\Data;

class Ajax extends Action
{
    /**
     * @var PageFactory
     */
    private $resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * Ajax constructor.
     *
     * @param Context $context
     * @param Data $helper
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     */
    public function __construct(
        Context $context,
        Data $helper,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
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
        $groupId = $this->getRequest()->getParam('groupId');
        $block = $resultPage->getLayout()
            ->createBlock(FaqBlock::class)
            ->setTemplate('Mageprince_Faq::faq_ajax.phtml')
            ->setGroupId($groupId)
            ->toHtml();

        $resultJson = $this->resultJsonFactory->create();
        $resultJson->setData(['faq' => $block]);

        return $resultJson;
    }
}
