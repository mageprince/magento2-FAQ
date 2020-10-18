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

namespace Mageprince\Faq\Observer;

use Magento\Framework\App\Config\Storage\WriterInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\UrlRewrite\Model\UrlRewriteFactory;

class ConfigChange implements ObserverInterface
{
    const REQUEST_PATH = 'faq';

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
     * ConfigChange constructor.
     *
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     * @param UrlRewriteFactory $urlRewriteFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter,
        UrlRewriteFactory $urlRewriteFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;
        $this->urlRewriteFactory = $urlRewriteFactory;
        $this->storeManager = $storeManager;
    }

    public function execute(EventObserver $observer)
    {
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
        return $this;
    }
}
