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
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Mageprince\Faq\Model\FaqGroupRepository;

class Delete extends FaqGroup
{
    /**
     * @var FaqGroupRepository
     */
    protected $faqGroupRepository;

    /**
     * Delete constructor.
     * @param Context $context
     * @param FaqGroupRepository $faqGroupRepository
     */
    public function __construct(
        Context $context,
        FaqGroupRepository $faqGroupRepository
    ) {
        $this->faqGroupRepository = $faqGroupRepository;
        parent::__construct($context);
    }

    /**
     * Delete action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('faqgroup_id');
        if ($id) {
            try {
                $this->faqGroupRepository->deleteById($id);
                $this->messageManager->addSuccessMessage(__('You deleted the Faq Group.'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
                return $resultRedirect->setPath('*/*/edit', ['faqgroup_id' => $id]);
            }
        }
        $this->messageManager->addErrorMessage(__('We can\'t find a Faq Group to delete.'));
        return $resultRedirect->setPath('*/*/');
    }
}
