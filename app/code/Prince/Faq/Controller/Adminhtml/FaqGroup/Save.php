<?php


namespace Prince\Faq\Controller\Adminhtml\FaqGroup;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();

        if ($data) {
            $id = $this->getRequest()->getParam('faqgroup_id');
        
            $model = $this->_objectManager->create('Prince\Faq\Model\FaqGroup')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Faqgroup no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }
            
            $data = $this->_filterFaqGroupData($data);

            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Faqgroup.'));
                $this->dataPersistor->clear('prince_faq_faqgroup');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['faqgroup_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Faqgroup.'));
            }
        
            $this->dataPersistor->set('prince_faq_faqgroup', $data);
            return $resultRedirect->setPath('*/*/edit', ['faqgroup_id' => $this->getRequest()->getParam('faqgroup_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }

    protected function _filterFaqGroupData(array $rawData)
    {
        $data = $rawData;
        // @todo It is a workaround to prevent saving this data in category model and it has to be refactored in future
        if (isset($data['icon']) && is_array($data['icon'])) {
            if (!empty($data['icon']['delete'])) {
                $data['icon'] = null;
            } else {
                if (isset($data['icon'][0]['name']) && isset($data['icon'][0]['tmp_name'])) {
                    $data['icon'] = $data['icon'][0]['name'];
                } else {
                    unset($data['icon']);
                }
            }
        }
        return $data;
    }
}
