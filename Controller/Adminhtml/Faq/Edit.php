<?php
/**
 * MagePrince
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the mageprince.com license that is
 * available through the world-wide-web at this URL:
 * https://mageprince.com/end-user-license-agreement
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    MagePrince
 * @package     Mageprince_Faq
 * @copyright   Copyright (c) MagePrince (https://mageprince.com/)
 * @license     https://mageprince.com/end-user-license-agreement
 */

namespace Mageprince\Faq\Controller\Adminhtml\Faq;

use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\View\Result\PageFactory;
use Mageprince\Faq\Model\FaqRepository;

class Edit extends Faq
{
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * Edit constructor.
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory,
        FaqRepository $faqRepository
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->faqRepository = $faqRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Mageprince_Faq::menu');

        if ($faqGroupId = (int) $this->getRequest()->getParam('faq_id')) {
            try {
                $faq = $this->faqRepository->getById($faqGroupId);
                $resultPage->getConfig()->getTitle()->prepend(__($faq->getTitle()));
            } catch (\Magento\Framework\Exception\NoSuchEntityException $e) {
                $this->messageManager->addErrorMessage(__('This FAQ no longer exists.'));

                return $this->_redirect('*/*/index');
            }
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('New FAQ'));
        }

        return $resultPage;
    }
}
