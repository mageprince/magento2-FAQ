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

namespace Mageprince\Faq\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Mageprince\Faq\Model\Config\DefaultConfig;
use Magento\Customer\Model\Session as CustomerSession;

class Data extends AbstractHelper
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param CustomerSession $customerSession
     */
    public function __construct(
        Context $context,
        CustomerSession $customerSession
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
    }

    /**
     * Get config path
     * @param $config
     * @return mixed
     */
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get faq url
     * @return string
     */
    public function getFaqUrl()
    {
        return $this->getConfig(DefaultConfig::FAQ_URL_CONFIG_PATH);
    }

    /**
     * Get current customer group id
     *
     * @return int
     */
    public function getCurrentCustomer()
    {
        $customerGroupId = 0;
        if ($this->customerSession->isLoggedIn()) {
            $customerGroupId = $this->customerSession->getCustomer()->getGroupId();
        }

        return $customerGroupId;
    }

    /**
     * Check is block data
     *
     * @param $data
     * @return bool
     */
    public function checkBlockData($data)
    {
        if ($data == '1') {
            return true;
        } elseif ($data == '0') {
            return false;
        }
    }
}
