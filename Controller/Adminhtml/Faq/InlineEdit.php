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

use Magento\Backend\App\Action;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Mageprince\Faq\Model\FaqRepository;

class InlineEdit extends Action
{
    /**
     * @var JsonFactory
     */
    protected $jsonFactory;

    /**
     * @var FaqRepository
     */
    protected $faqRepository;

    /**
     * InlineEdit constructor.
     * @param Action\Context $context
     * @param JsonFactory $jsonFactory
     * @param FaqRepository $faqRepository
     */
    public function __construct(
        Action\Context $context,
        JsonFactory $jsonFactory,
        FaqRepository $faqRepository
    ) {
        $this->jsonFactory = $jsonFactory;
        $this->faqRepository = $faqRepository;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mageprince_Faq::Faq');
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
                foreach (array_keys($postItems) as $faqId) {
                    try {
                        $model = $this->faqRepository->getById($faqId);
                        $model->setData(array_merge($model->getData(), $postItems[$faqId]));
                        $this->faqRepository->save($model);
                    } catch (\Exception $e) {
                        $messages[] = "[Faq ID: {$faqId}]  {$e->getMessage()}";
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
