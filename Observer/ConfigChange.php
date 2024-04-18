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

namespace Mageprince\Faq\Observer;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class ConfigChange implements ObserverInterface
{
    private const REQUEST_PATH = 'faq';

    /**
     * @var RequestInterface
     */
    protected $request;

    /**
     * @var WriterInterface
     */
    protected $configWriter;

    /**
     * @var UrlRewriteFactory
     */
    protected $urlRewriteFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    protected $logger;

    /**
     * ConfigChange constructor.
     *
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     * @param UrlRewriteFactory $urlRewriteFactory
     * @param StoreManagerInterface $storeManager
     * @param \Psr\Log\LoggerInterface $logger
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter,
        UrlRewriteFactory $urlRewriteFactory,
        StoreManagerInterface $storeManager,
        \Psr\Log\LoggerInterface $logger
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->storeManager = $storeManager;
        $this->logger = $logger;
    }

    /**
     * Save FAQ url
     *
     * @param EventObserver $observer
     * @return $this|void
     */
    public function execute(EventObserver $observer)
    {
        try {
            $faqParams = $this->request->getParam('groups');
            if (!empty($faqParams['seo']['fields']['faq_url'])) {
                $faqUrlVal = $faqParams['seo']['fields']['faq_url'];
                $urlKey = str_replace(' ', '-', $faqUrlVal['value']);
                $filterUrlKey = preg_replace('/[^A-Za-z0-9\-]/', '', $urlKey);
                $this->configWriter->save('faqtab/seo/faq_url', $filterUrlKey);
                $stores = $this->storeManager->getStores();
                foreach ($stores as $store) {
                    $urlRewriteModel = $this->urlRewriteFactory->create();
                    $rewriteCollection = $urlRewriteModel->getCollection()
                        ->addFieldToFilter('request_path', self::REQUEST_PATH)
                        ->addFieldToFilter('store_id', $store->getId())
                        ->getFirstItem();
                    $urlRewriteModel->load($rewriteCollection->getId());
                    if ($filterUrlKey == self::REQUEST_PATH) {
                        if ($urlRewriteModel->getId()) {
                            $urlRewriteModel->delete();
                        }
                    } else {
                        $urlRewriteModel->setStoreId($store->getId());
                        $urlRewriteModel->setTargetPath($filterUrlKey);
                        $urlRewriteModel->setRequestPath(self::REQUEST_PATH);
                        $urlRewriteModel->setredirectType(301);
                        $urlRewriteModel->save();
                    }
                }
            }
        } catch (\Exception $e) {
            $this->logger->error('FAQ url save error:' . $e->getMessage());
        }
        return $this;
    }
}
