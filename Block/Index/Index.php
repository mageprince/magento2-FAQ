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

namespace Mageprince\Faq\Block\Index;

use Magento\Cms\Model\Template\FilterProvider;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\ScopeInterface;
use Magento\Widget\Block\BlockInterface;
use Mageprince\Faq\Api\Data\FaqGroupInterface;
use Mageprince\Faq\Api\FaqGroupRepositoryInterface;
use Mageprince\Faq\Helper\Data as HelperData;
use Mageprince\Faq\Model\Config\DefaultConfig;
use Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\Collection as FaqGroupCollection;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory as FaqGroupCollectionFactory;

class Index extends Template implements BlockInterface
{
    /**
     * Default faq template
     *
     * @var string
     */
    protected $_template = DefaultConfig::FAQ_MAIN_TEMPLATE_FILE;

    /**
     * @var CollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * @var FaqGroupCollectionFactory
     */
    protected $faqGroupCollectionFactory;

    /**
     * @var HelperData
     */
    protected $customerSession;

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
     * @param Template\Context $context
     * @param CollectionFactory $faqCollectionFactory
     * @param FaqGroupRepositoryInterface $faqGroupRepository
     * @param FaqGroupCollectionFactory $faqGroupCollectionFactory
     * @param FilterProvider $filterProvider
     * @param HelperData $helper
     */
    public function __construct(
        Template\Context $context,
        CollectionFactory $faqCollectionFactory,
        FaqGroupRepositoryInterface $faqGroupRepository,
        FaqGroupCollectionFactory $faqGroupCollectionFactory,
        FilterProvider $filterProvider,
        HelperData $helper
    ) {
        $this->faqCollectionFactory = $faqCollectionFactory;
        $this->faqGroupCollectionFactory = $faqGroupCollectionFactory;
        $this->faqGroupRepository = $faqGroupRepository;
        $this->helper = $helper;
        $this->filterProvider = $filterProvider;
        parent::__construct($context);
    }

    /**
     * Get faq collection
     *
     * @param int $group
     * @return \Mageprince\Faq\Model\ResourceModel\Faq\Collection
     * @throws NoSuchEntityException
     */
    public function getFaqCollection($group)
    {
        $faqCollection = $this->faqCollectionFactory->create();
        $faqCollection->addFieldToFilter(
            'group',
            [
                ['null' => true],
                ['finset' => $group]
            ]
        );
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
        if ($this->getGroupId()) {
            $faqGroupCollection->addFieldToFilter('faqgroup_id', ['in' => $this->getGroupId()]);
        }
        return $faqGroupCollection;
    }

    /**
     * Filter collection data
     *
     * @param AbstractCollection $collection
     * @throws NoSuchEntityException
     */
    private function filterCollectionData($collection)
    {
        $collection->addFieldToFilter('status', 1);
        $collection->addFieldToFilter(
            'customer_group',
            [
                ['null' => true],
                ['finset' => $this->helper->getCustomerGroupId()]
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
     * @param int $groupId
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
     * @param string $string
     * @return string
     */
    public function filterOutputHtml($string)
    {
        $output = '';
        try {
            $output = $this->filterProvider->getPageFilter()->filter($string);
        } catch (\Exception $e) {
            $this->_logger->error('Faq filter output error: ' . $e->getMessage());
        }
        return $output;
    }

    /**
     * Get icon image url
     *
     * @param string $icon
     * @return string
     */
    public function getImageUrl($icon)
    {
        $imageUrl = '';
        try {
            $mediaUrl = $this->_storeManager
                ->getStore()
                ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
            $imageUrl = $mediaUrl . DefaultConfig::ICON_TMP_PATH . $icon;
        } catch (\Exception $e) {
            $this->_logger->error('Faq get image error:' . $e->getMessage());
        }

        return $imageUrl;
    }

    /**
     * Get config value
     *
     * @param string $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->_scopeConfig->getValue(
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
        return $this->_storeManager->getStore()->getId();
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
        if ($this->getPageType() == DefaultConfig::FAQ_PAGE_TYPE_AJAX) {
            $pageType = DefaultConfig::FAQ_PAGE_TYPE_AJAX;
        } elseif ($this->getPageType() == DefaultConfig::FAQ_PAGE_TYPE_SCROLL) {
            $pageType = DefaultConfig::FAQ_PAGE_TYPE_SCROLL;
        } else {
            $pageType = $this->getConfig(DefaultConfig::CONFIG_PATH_PAGE_TYPE);
        }
        return $pageType;
    }

    /**
     * Check is faqs collapse expand enabled
     *
     * @return bool
     */
    public function isCollapseExpandEnabled()
    {
        if ($this->getEnableCollapseExpand() != null) {
            $isEnable = $this->getEnableCollapseExpand();
        } else {
            $isEnable = $this->getConfig(DefaultConfig::CONFIG_PATH_IS_ENABLED_COLLAPSE_EXPAND);
        }
        return $isEnable;
    }

    /**
     * Get ajax url
     *
     * @return string
     */
    public function getAjaxUrl()
    {
        return $this->getUrl(DefaultConfig::FAQ_PAGE_AJAX_URL);
    }
}
