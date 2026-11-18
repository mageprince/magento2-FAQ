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

namespace Mageprince\Faq\Controller\Index;

use Magento\Framework\App\Action;
use Magento\Framework\App\Cache\Type\Block as TypeBlock;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Model\StoreManagerInterface;
use Mageprince\Faq\Block\Index\Index as FaqBlock;
use Mageprince\Faq\Helper\Data;
use Mageprince\Faq\Model\Config\DefaultConfig;

class Ajax extends Action\Action
{
    /**
     * Cache key
     */
    private const FAQ_GROUP_CACHE_KEY = 'mageprince_faq_group_';

    /**
     * @var PageFactory
     */
    protected $resultPageFactory;

    /**
     * @var JsonFactory
     */
    protected $resultJsonFactory;

    /**
     * @var Data
     */
    protected $helper;

    /**
     * @var CacheInterface
     */
    protected $cache;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * Ajax constructor.
     * @param Action\Context $context
     * @param Data $helper
     * @param PageFactory $resultPageFactory
     * @param JsonFactory $resultJsonFactory
     * @param CacheInterface $cache
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        Action\Context $context,
        Data $helper,
        PageFactory $resultPageFactory,
        JsonFactory $resultJsonFactory,
        CacheInterface $cache,
        StoreManagerInterface $storeManager
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
        $this->resultJsonFactory = $resultJsonFactory;
        parent::__construct($context);
        $this->cache = $cache;
        $this->storeManager = $storeManager;
    }

    /**
     * Ajax request
     *
     * @return ResultInterface|void
     */
    public function execute()
    {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $groupId = $this->getRequest()->getParam('groupId');
            $faqHtml = $this->getFaqHtml($groupId);
            $resultJson = $this->resultJsonFactory->create();
            $resultJson->setData(['faq' => $faqHtml]);
            return $resultJson;
        }
    }

    /**
     * Get faq html from cache
     *
     * @param int $groupId
     * @return string
     */
    protected function getFaqHtml($groupId)
    {
        $isHyva = (bool)$this->getRequest()->getParam('hyva');
        $faqHtml = $this->cache->load($this->getCacheKey($groupId, $isHyva));
        if (false === $faqHtml) {
            $resultPage = $this->resultPageFactory->create();
            $faqHtml = $resultPage->getLayout()
                ->createBlock(FaqBlock::class, '', [
                    'data' => [
                        'template' => $isHyva
                            ? DefaultConfig::FAQ_AJAX_HYVA_TEMPLATE_FILE
                            : DefaultConfig::FAQ_AJAX_TEMPLATE_FILE
                    ]
                ])
                ->setGroupId($groupId)
                ->toHtml();

            $this->cache->save(
                $faqHtml,
                $this->getCacheKey($groupId, $isHyva),
                [
                    TypeBlock::TYPE_IDENTIFIER
                ]
            );
        }
        return $faqHtml;
    }

    /**
     * Retrieve cache key
     *
     * @param int $groupId
     * @param bool $isHyva
     * @return string
     * @throws NoSuchEntityException
     */
    protected function getCacheKey($groupId, $isHyva = false)
    {
        return self::FAQ_GROUP_CACHE_KEY . $groupId
            . '_store_' . $this->storeManager->getStore()->getId()
            . '_customer_group_' . $this->helper->getCustomerGroupId()
            . ($isHyva ? '_hyva' : '');
    }
}
