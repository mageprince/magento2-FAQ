<?php

namespace Prince\Faq\Helper;

class Data extends \Magento\Framework\App\Helper\AbstractHelper
{
    public function getConfig($config)
    {
        return $this->scopeConfig->getValue(
            $config,
            \Magento\Store\Model\ScopeInterface::SCOPE_STORE
        );
    }
}
