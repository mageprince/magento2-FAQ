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
use Magento\Ui\Component\MassAction\Filter;
use Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory;

class MassDelete extends Faq
{
    /**
     * @var Filter
     */
    protected $filter;

    /**
     * @var CollectionFactory
     */
    protected $collectionFactory;

    /**
     * MassDelete constructor.
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param Action\Context $context
     */
    public function __construct(
        Filter $filter,
        CollectionFactory $collectionFactory,
        Action\Context $context
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        parent::__construct($context);
    }

    /**
     * @inheritdoc
     */
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Mageprince_Faq::Faq');
    }

    public function execute()
    {
        try {
            $logCollection = $this->filter->getCollection($this->collectionFactory->create());
            $itemsDeleted = 0;
            foreach ($logCollection as $item) {
                $item->delete();
                $itemsDeleted++;
            }
            $this->messageManager->addSuccessMessage(__('A total of %1 FAQ(s) were deleted.', $itemsDeleted));
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e->getMessage());
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('mageprince_faq/faq');
    }
}
