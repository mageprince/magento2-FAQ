<?php


namespace Prince\Faq\Controller\Adminhtml;

abstract class Faq extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Prince_Faq::top_level';
    private $coreRegistry;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry
    ) {
        $this->coreRegistry = $coreRegistry;
        parent::__construct($context);
    }

    /**
     * Init page
     *
     * @param \Magento\Backend\Model\View\Result\Page $resultPage
     */
    public function initPage($resultPage)
    {
        $resultPage->setActiveMenu(self::ADMIN_RESOURCE)
            ->addBreadcrumb(__('Prince'), __('Prince'))
            ->addBreadcrumb(__('FAQ'), __('FAQ'));
        return $resultPage;
    }
}
