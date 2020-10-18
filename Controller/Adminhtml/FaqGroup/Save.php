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

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Redirect;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\LocalizedException;
use Mageprince\Faq\Model\FaqGroupFactory;
use Mageprince\Faq\Model\FaqGroupRepository;
use Mageprince\Faq\Model\ImageUploader;

class Save extends FaqGroup
{
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var ImageUploader
     */
    protected $imageUploader;

    /**
     * @var FaqGroupRepository
     */
    protected $faqGroupRepository;

    /**
     * @var FaqGroupFactory
     */
    protected $faqGroupFactory;

    /**
     * Save constructor.
     *
     * @param Action\Context $context
     * @param FaqGroupFactory $faqGroupFactory
     * @param DataPersistorInterface $dataPersistor
     * @param ImageUploader $imageUploader
     * @param FaqGroupRepository $faqGroupRepository
     */
    public function __construct(
        Action\Context $context,
        FaqGroupFactory $faqGroupFactory,
        DataPersistorInterface $dataPersistor,
        ImageUploader $imageUploader,
        FaqGroupRepository $faqGroupRepository
    ) {
        $this->dataPersistor = $dataPersistor;
        $this->faqGroupFactory = $faqGroupFactory;
        $this->imageUploader = $imageUploader;
        $this->faqGroupRepository = $faqGroupRepository;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return ResultInterface
     */
    public function execute()
    {
        /** @var Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();

        if ($data = $this->getRequest()->getPostValue()) {
            $model = $this->faqGroupFactory->create();
            try {
                if ($id = (int) $this->getRequest()->getParam('faqgroup_id')) {
                    $model = $this->faqGroupRepository->getById($id);
                    if ($id != $model->getId()) {
                        $this->messageManager->addErrorMessage(__('This FAQ Group no longer exists.'));
                        return $resultRedirect->setPath('*/*/');
                    }
                }

                $data = $this->_filterFaqGroupData($data);
                $model->addData($data);
                $this->faqGroupRepository->save($model);
                $this->messageManager->addSuccessMessage(__('You saved the FAQ Group.'));
                $this->dataPersistor->clear('prince_faq_faqgroup');

                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['faqgroup_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage(
                    $e,
                    __('Something went wrong while saving the Faqgroup.')
                );
            }

            $this->dataPersistor->set('prince_faq_faqgroup', $data);
            return $resultRedirect->setPath(
                '*/*/edit',
                [
                    'faqgroup_id' => $this->getRequest()->getParam('faqgroup_id')
                ]
            );
        }
        return $resultRedirect->setPath('*/*/');
    }

    /**
     * Filter faq group data
     *
     * @param array $rawData
     * @return array
     */
    protected function _filterFaqGroupData(array $rawData)
    {
        $data = $rawData;
        if (isset($data['icon'][0]['name'])) {
            $data['icon'] = $data['icon'][0]['name'];
        } else {
            $data['icon'] = null;
        }

        $cGroup = $data['customer_group'];
        if (isset($cGroup)) {
            $customerGroup = implode(',', $data['customer_group']);
            $data['customer_group'] = $customerGroup;
        }

        $stores = $data['storeview'];
        if (isset($stores)) {
            $store = implode(',', $data['storeview']);
            $data['storeview'] = $store;
        }

        return $data;
    }
}
