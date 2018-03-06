<?php

/**
 * MagePrince
 * Copyright (C) 2018 Mageprince
 *
 * NOTICE OF LICENSE
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see http://opensource.org/licenses/gpl-3.0.html
 *
 * @category MagePrince
 * @package Prince_Faq
 * @copyright Copyright (c) 2018 MagePrince
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince
 */

namespace Prince\Faq\Model;

use Prince\Faq\Model\ResourceModel\FaqGroup as ResourceFaqGroup;
use Magento\Framework\Exception\CouldNotSaveException;
use Prince\Faq\Api\Data\FaqGroupSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use Prince\Faq\Api\Data\FaqGroupInterfaceFactory;
use Prince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory as FaqGroupCollectionFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Api\SortOrder;
use Prince\Faq\Api\FaqGroupRepositoryInterface;

class FaqGroupRepository implements FaqGroupRepositoryInterface
{

    /**
     * @var \Magento\Store\Model\StoreManagerInterface
     */
    private $storeManager;

    /**
     * @var \Prince\Faq\Model\ResourceModel\FaqGroup
     */
    private $resource;

    /**
     * @var \Prince\Faq\Api\Data\FaqGroupFactory
     */
    private $FaqGroupFactory;

    /**
     * @var \Prince\Faq\Api\Data\FaqGroupInterfaceFactory
     */
    private $dataFaqGroupFactory;

    /**
     * @var \Prince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory
     */
    private $FaqGroupCollectionFactory;

    /**
     * @var \Magento\Framework\Reflection\DataObjectProcessor
     */
    private $dataObjectProcessor;

    /**
     * @var \Magento\Framework\Api\DataObjectHelper
     */
    private $dataObjectHelper;

    /**
     * @var \Prince\Faq\Api\Data\FaqGroupSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @param ResourceFaqGroup $resource
     * @param FaqGroupFactory $faqGroupFactory
     * @param FaqGroupInterfaceFactory $dataFaqGroupFactory
     * @param FaqGroupCollectionFactory $faqGroupCollectionFactory
     * @param FaqGroupSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceFaqGroup $resource,
        FaqGroupFactory $faqGroupFactory,
        FaqGroupInterfaceFactory $dataFaqGroupFactory,
        FaqGroupCollectionFactory $faqGroupCollectionFactory,
        FaqGroupSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->faqGroupFactory = $faqGroupFactory;
        $this->faqGroupCollectionFactory = $faqGroupCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataFaqGroupFactory = $dataFaqGroupFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \Prince\Faq\Api\Data\FaqGroupInterface $faqGroup
    ) {
        try {
            $faqGroup->getResource()->save($faqGroup);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the faqGroup: %1',
                $exception->getMessage()
            ));
        }
        return $faqGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($faqGroupId)
    {
        $faqGroup = $this->faqGroupFactory->create();
        $faqGroup->getResource()->load($faqGroup, $faqGroupId);
        if (!$faqGroup->getId()) {
            throw new NoSuchEntityException(__('FaqGroup with id "%1" does not exist.', $faqGroupId));
        }
        return $faqGroup;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->faqGroupCollectionFactory->create();
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
     * {@inheritdoc}
     */
    public function delete(
        \Prince\Faq\Api\Data\FaqGroupInterface $faqGroup
    ) {
        try {
            $faqGroup->getResource()->delete($faqGroup);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the FaqGroup: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($faqGroupId)
    {
        return $this->delete($this->getById($faqGroupId));
    }
}
