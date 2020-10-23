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

use Magento\Customer\Model\Session as CustomerSession;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Store\Model\ScopeInterface;
use Mageprince\Faq\Model\Config\DefaultConfig;
use Magento\Framework\App\Http\Context as AuthContext;

class Data extends AbstractHelper
{
    /**
     * @var CustomerSession
     */
    protected $customerSession;

    /**
     * @var AuthContext
     */
    protected $authContext;

    /**
     * Data constructor.
     *
     * @param Context $context
     * @param CustomerSession $customerSession
     * @param AuthContext $authContext
     */
    public function __construct(
        Context $context,
        CustomerSession $customerSession,
        AuthContext $authContext
    ) {
        parent::__construct($context);
        $this->customerSession = $customerSession;
        $this->authContext = $authContext;
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
            ScopeInterface::SCOPE_STORE
        );
    }

    /**
     * Get faq url
     * @return string
     */
    public function getFaqUrl()
    {
        return $this->scopeConfig->getValue(DefaultConfig::FAQ_URL_CONFIG_PATH);
    }

    /**
     * Get current customer group id
     *
     * @return int
     */
    public function getCustomerGroupId()
    {
        $customerGroup = 0;
        $isLoggedIn = $this->authContext->getValue(\Magento\Customer\Model\Context::CONTEXT_AUTH);
        if ($isLoggedIn) {
            $customerGroup = $this->customerSession->getCustomer()->getGroupId();
        }
        return $customerGroup;
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

    /**
     * Check is module enabled
     *
     * @return bool
     */
    public function isEnable()
    {
        return $this->scopeConfig->getValue(DefaultConfig::CONFIG_PATH_IS_ENABLE);
    }
}
