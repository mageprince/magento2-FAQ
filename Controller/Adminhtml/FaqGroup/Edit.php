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

namespace Mageprince\Faq\Controller\Adminhtml\FaqGroup;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Mageprince\Faq\Model\FaqGroupRepository;

class Edit extends FaqGroup
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var FaqGroupRepository
     */
    protected $faqGroupRepository;

    /**
     * Index constructor.
     *
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param FaqGroupRepository $faqGroupRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        FaqGroupRepository $faqGroupRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->faqGroupRepository = $faqGroupRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Mageprince_Faq::menu');

        if ($faqGroupId = (int)$this->getRequest()->getParam('faqgroup_id')) {
            try {
                $faqGroup = $this->faqGroupRepository->getById($faqGroupId);
                $resultPage->getConfig()->getTitle()->prepend(__($faqGroup->getGroupName()));
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This Faq Group no longer exists.'));

                return $this->_redirect('*/*/index');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New Faq Group'));
        }

        return $resultPage;
    }
}
