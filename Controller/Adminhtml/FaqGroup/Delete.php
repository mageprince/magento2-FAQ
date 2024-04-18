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
