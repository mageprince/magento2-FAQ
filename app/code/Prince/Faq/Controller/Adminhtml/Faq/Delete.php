<?php


namespace Prince\Faq\Controller\Adminhtml\Faq;

class Delete extends \Prince\Faq\Controller\Adminhtml\Faq
{

    /**
     * @var \Prince\Faq\Model\Faq
     */
    private $faqModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Prince\Faq\Model\Faq $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Prince\Faq\Model\Faq $faqModel
    ) {
        $this->faqModel = $faqModel;
        parent::__construct($context);
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
        $id = $this->getRequest()->getParam('faq_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->faqModel;
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the FAQ.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['faq_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a FAQ to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
