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

namespace Mageprince\Faq\Block;

use Magento\Framework\View\Element\Html\Link;
use Magento\Store\Model\ScopeInterface;

class FooterLink extends Link
{
    public function _toHtml()
    {
        $isEnable = $this->_scopeConfig->isSetFlag(
            'faqtab/general/enable',
            ScopeInterface::SCOPE_STORE
        );
        $isFooterLinkEnable = $this->_scopeConfig->isSetFlag(
            'faqtab/design/footerlink',
            ScopeInterface::SCOPE_STORE
        );
        if (!$isEnable || !$isFooterLinkEnable) {
            return '';
        }
        return parent::_toHtml();
    }
}
