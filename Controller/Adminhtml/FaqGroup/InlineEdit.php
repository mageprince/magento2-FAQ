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

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Mageprince\Faq\Model\FaqGroupRepository;

class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var FaqGroupRepository
     */
    protected $faqGroupRepository;

    /**
     * InlineEdit constructor.
     * @param Action\Context $context
     * @param JsonFactory $jsonFactory
     * @param FaqGroupRepository $faqGroupRepository
     */
    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        FaqGroupRepository $faqGroupRepository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->faqGroupRepository = $faqGroupRepository;
        parent::__construct($context);
    }

    /**
     * {@inheritdoc}
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mageprince_Faq::FaqGroup');
    }

    /**
     * Inline edit action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (empty($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $faqGroupId) {
                    try {
                        $model = $this->faqGroupRepository->getById($faqGroupId);
                        $model->setData(array_merge($model->getData(), $postItems[$faqGroupId]));
                        $this->faqGroupRepository->save($model);
                    } catch (\Exception $e) {
                        $messages[] = "[Faqgroup ID: {$faqGroupId}]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
