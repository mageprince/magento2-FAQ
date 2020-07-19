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

class HeaderLink extends Link
{
    public function _toHtml()
    {
        if (!$this->_scopeConfig->isSetFlag('faqtab/general/enable') ||
            !$this->_scopeConfig->isSetFlag('faqtab/design/headerlink')
        ) {
            return '';
        }
        return parent::_toHtml();
    }
}
