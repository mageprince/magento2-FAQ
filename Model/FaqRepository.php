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

namespace Mageprince\Faq\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Mageprince\Faq\Api\Data\FaqInterface;
use Mageprince\Faq\Api\Data\FaqSearchResultsInterfaceFactory;
use Mageprince\Faq\Api\FaqRepositoryInterface;
use Mageprince\Faq\Model\ResourceModel\Faq as ResourceFaq;
use Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;

class FaqRepository implements FaqRepositoryInterface
{
    /**
     * @var \Mageprince\Faq\Model\ResourceModel\Faq
     */
    protected $resource;

    /**
     * @var \Mageprince\Faq\Api\Data\FaqSearchResultsInterfaceFactory
     */
    protected $searchResultsFactory;

    /**
     * @var FaqCollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * @var FaqFactory
     */
    protected $faqFactory;

    /**
     * FaqRepository constructor.
     * @param ResourceFaq $resource
     * @param FaqFactory $faqFactory
     * @param FaqCollectionFactory $faqCollectionFactory
     * @param FaqSearchResultsInterfaceFactory $searchResultsFactory
     */
    public function __construct(
        ResourceFaq $resource,
        FaqFactory $faqFactory,
        FaqCollectionFactory $faqCollectionFactory,
        FaqSearchResultsInterfaceFactory $searchResultsFactory
    ) {
        $this->resource = $resource;
        $this->faqFactory = $faqFactory;
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
    }

    /**
     * Save FAQ.
     *
     * @param FaqInterface $faq
     * @return FaqInterface
     * @throws CouldNotSaveException
     */
    public function save(FaqInterface $faq)
    {
        try {
            $this->resource->save($faq);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the faq: %1',
                $exception->getMessage()
            ));
        }
        return $faq;
    }

    /**
     * Get FAQ by id.
     *
     * @param int $faqId
     * @return FaqInterface
     * @throws NoSuchEntityException
     */
    public function getById($faqId)
    {
        $faq = $this->faqFactory->create();
        $this->resource->load($faq, $faqId);
        if (!$faq->getId()) {
            throw new NoSuchEntityException(__('Faq with id "%1" does not exist.', $faqId));
        }
        return $faq;
    }

    /**
     * Get FAQ list.
     *
     * @param \Magento\Framework\Api\SearchCriteriaInterface $criteria
     * @return \Mageprince\Faq\Api\Data\FaqSearchResultsInterface
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->faqCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());

        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * Delete FAQ.
     *
     * @param FaqInterface $faq
     * @return bool
     * @throws CouldNotDeleteException
     */
    public function delete(FaqInterface $faq)
    {
        try {
            $this->resource->delete($faq);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Faq: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * Delete FAQ by id.
     *
     * @param int $faqId
     * @return bool
     * @throws CouldNotDeleteException
     * @throws NoSuchEntityException
     */
    public function deleteById($faqId)
    {
        return $this->delete($this->getById($faqId));
    }
}
