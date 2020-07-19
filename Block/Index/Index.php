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

namespace Mageprince\Faq\Block\Index;

use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageprince\Faq\Api\Data\FaqGroupInterface;
use Mageprince\Faq\Api\FaqGroupRepositoryInterface;
use Mageprince\Faq\Model\FaqGroupFactory;
use Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\Collection as FaqGroupCollection;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory as FaqGroupCollectionFactory;
use Mageprince\Faq\Model\Config\DefaultConfig;
use Mageprince\Faq\Helper\Data as HelperData;

class Index extends Template
{
    /**
     * Default faq template
     * @var string
     */
    protected $_template = 'Mageprince_Faq::faq_main.phtml';

    /**
     * @var CollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * @var FaqGroupCollectionFactory
     */
    protected $faqGroupCollectionFactory;

    /**
     * @var FaqGroupFactory
     */
    protected $faqGroupFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var HelperData
     */
    protected $customerSession;

    /**
     * @var ScopeConfigInterface
     */
    protected $scopeConfig;

    /**
     * @var HelperData
     */
    protected $helper;

    /**
     * @var FaqGroupRepositoryInterface
     */
    protected $faqGroupRepository;

    /**
     * @var FilterProvider
     */
    protected $filterProvider;

    /**
     * Index constructor.
     *
     * @param Template\Context $context
     * @param CollectionFactory $faqCollectionFactory
     * @param FaqGroupRepositoryInterface $faqGroupRepository
     * @param FaqGroupCollectionFactory $faqGroupCollectionFactory
     * @param FaqGroupFactory $faqGroupFactory
     * @param FilterProvider $filterProvider
     * @param HelperData $helper
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $faqCollectionFactory,
        FaqGroupRepositoryInterface $faqGroupRepository,
        FaqGroupCollectionFactory $faqGroupCollectionFactory,
        FaqGroupFactory $faqGroupFactory,
        FilterProvider $filterProvider,
        HelperData $helper
    ) {
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->faqGroupCollectionFactory = $faqGroupCollectionFactory;
        $this->faqGroupRepository = $faqGroupRepository;
        $this->faqGroupFactory = $faqGroupFactory;
        $this->storeManager = $context->getStoreManager();
        $this->scopeConfig = $context->getScopeConfig();
        $this->helper = $helper;
        $this->filterProvider = $filterProvider;
        parent::__construct($context);
    }

    /**
     * Get faq collection
     *
     * @param $group
     * @return \Mageprince\Faq\Model\ResourceModel\Faq\Collection
     * @throws NoSuchEntityException
     */
    public function getFaqCollection($group)
    {
        if ($this->getGroupId()) {
            $group = $this->getGroupId();
        }
        $faqCollection = $this->faqCollectionFactory->create();
        $faqCollection->addFieldToFilter('group', ['like' => '%'.$group.'%']);
        $this->filterCollectionData($faqCollection);
        return $faqCollection;
    }

    /**
     * Get faq group collection
     *
     * @return FaqGroupCollection
     * @throws NoSuchEntityException
     */
    public function getFaqGroupCollection()
    {
        $faqGroupCollection = $this->faqGroupCollectionFactory->create();
        $this->filterCollectionData($faqGroupCollection);
        return $faqGroupCollection;
    }

    /**
     * Filter collection data
     *
     * @param $collection
     * @throws NoSuchEntityException
     */
    private function filterCollectionData($collection)
    {
        $collection->addFieldToFilter('status', 1);
        $collection->addFieldToFilter(
            'customer_group',
            [
                ['null' => true],
                ['finset' => $this->helper->getCurrentCustomer()]
            ]
        );
        $collection->addFieldToFilter(
            'storeview',
            [
                ['eq' => 0],
                ['finset' => $this->getCurrentStore()]
            ]
        );
        $collection->setOrder('sortorder', 'ASC');
    }

    /**
     * Get group by id
     *
     * @param $groupId
     * @return FaqGroupInterface
     * @throws LocalizedException
     */
    public function getGroupById($groupId)
    {
        return $this->faqGroupRepository->getById($groupId);
    }

    /**
     * Filter faq content
     *
     * @param $string
     * @return string
     * @throws \Exception
     */
    public function filterOutputHtml($string)
    {
        return $this->filterProvider->getPageFilter()->filter($string);
    }

    /**
     * Get icon image url
     *
     * @param $icon
     * @return string
     * @throws NoSuchEntityException
     */
    public function getImageUrl($icon)
    {
        $mediaUrl = $this->storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        $imageUrl = $mediaUrl.'faq/tmp/icon/'.$icon;
        return $imageUrl;
    }

    /**
     * Get config value
     *
     * @param $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get current store id
     *
     * @return int
     * @throws NoSuchEntityException
     */
    public function getCurrentStore()
    {
        return $this->storeManager->getStore()->getId();
    }

    /**
     * Check is module enabled
     *
     * @return bool
     */
    public function isEnable()
    {
        return $this->getConfig(DefaultConfig::CONFIG_PATH_IS_ENABLE);
    }

    /**
     * Check is group enabled
     *
     * @return bool
     */
    public function isShowGroup()
    {
        if ($this->getShowGroup() != null) {
            return $this->helper->checkBlockData($this->getShowGroup());
        } else {
            return $this->getConfig(DefaultConfig::CONFIG_PATH_IS_SHOW_GROUP);
        }
    }

    /**
     * Check is group title enabled
     *
     * @return bool
     */
    public function isShowGroupTitle()
    {
        if ($this->getShowGroupTitle() != null) {
            return $this->helper->checkBlockData($this->getShowGroupTitle());
        } else {
            return $this->getConfig(DefaultConfig::CONFIG_PATH_IS_SHOW_GROUP_TITLE);
        }
    }

    /**
     * Get faq page type action
     *
     * @return string
     */
    public function getPageTypeAction()
    {
        if ($this->getPageType() == 'ajax') {
            $pageType = 'ajax';
        } elseif ($this->getPageType() == 'scroll') {
            $pageType = 'scroll';
        } else {
            $pageType = $this->getConfig(DefaultConfig::CONFIG_PATH_PAGE_TYPE);
        }
        return $pageType;
    }
}
