<?php

/**
 * MagePrince
 * Copyright (C) 2020 Mageprince <info@mageprince.com>
 *
 * @package Prince_Faq
 * @copyright Copyright (c) 2020 Mageprince (http://www.mageprince.com/)
 * @license http://opensource.org/licenses/gpl-3.0.html GNU General Public License,version 3 (GPL-3.0)
 * @author MagePrince <info@mageprince.com>
 */

namespace Prince\Faq\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Config\Storage\WriterInterface;

class ConfigChange implements ObserverInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var WriterInterface
     */
    private $configWriter;

    /**
     * ConfigChange constructor.
     * @param RequestInterface $request
     * @param WriterInterface $configWriter
     */
    public function __construct(
        RequestInterface $request,
        WriterInterface $configWriter
    ) {
        $this->request = $request;
        $this->configWriter = $configWriter;
    }

    public function execute(EventObserver $observer)
    {
        $faqParams = $this->request->getParam('groups');
        $faqUrlVal = $faqParams['seo']['fields']['faq_url']['value'];
        if($faqUrlVal) {
            $urlKey = str_replace(' ', '-', $faqUrlVal);
            $filterUrlKey = preg_replace('/[^A-Za-z0-9\-]/', '', $urlKey);
            $this->configWriter->save('faqtab/seo/faq_url', $filterUrlKey);
        }
        return $this;
    }
}
