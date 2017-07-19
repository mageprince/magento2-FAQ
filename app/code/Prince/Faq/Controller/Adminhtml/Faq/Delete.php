<?php


namespace Prince\Faq\Controller\Adminhtml\Faq;

class Delete extends \Prince\Faq\Controller\Adminhtml\Faq
{
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
                $model = $this->_objectManager->create('Prince\Faq\Model\Faq');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Faq.'));
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
        $this->messageManager->addErrorMessage(__('We can\'t find a Faq to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
