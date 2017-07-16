<?php


namespace Prince\Faq\Controller\Adminhtml\Faq;

class Edit extends \Prince\Faq\Controller\Adminhtml\Faq
{

    private $resultPageFactory;

    /**
     * @var \Prince\Faq\Model\Faq
     */
    private $faqModel;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     * @param \Prince\Faq\Model\Faq $faqModel
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Prince\Faq\Model\Faq $faqModel
    ) {
        $this->resultPageFactory = $resultPageFactory;
        $this->faqModel = $faqModel;
        parent::__construct($context, $coreRegistry);
    }

    /**
     * Edit action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('faq_id');
        $model = $this->faqModel;
        
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addErrorMessage(__('This FAQ no longer exists.'));
                /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }
        $this->_coreRegistry->register('prince_faq_faq', $model);
        
        // 5. Build edit form
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $this->initPage($resultPage)->addBreadcrumb(
            $id ? __('Edit Faq') : __('New FAQ'),
            $id ? __('Edit Faq') : __('New FAQ')
        );
        $resultPage->getConfig()->getTitle()->prepend(__('FAQs'));
        $resultPage->getConfig()->getTitle()->prepend($model->getId() ? $model->getTitle() : __('New Faq'));
        return $resultPage;
    }
}
