<?php


namespace Prince\Faq\Controller\Adminhtml\FaqGroup;

class Delete extends \Prince\Faq\Controller\Adminhtml\FaqGroup
{

    /**
     * @var \Prince\Faq\Model\FaqGroup
     */
    private $faqGroupModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $jsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Prince\Faq\Model\FaqGroup $faqGroupModel
    ) {
        parent::__construct($context);
        $this->faqGroupModel = $faqGroupModel;
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('faqgroup_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->faqGroupModel;
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the FAQgroup.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['faqgroup_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a FAQgroup to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
