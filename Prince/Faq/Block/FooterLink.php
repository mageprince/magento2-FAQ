<?php


namespace Prince\Faq\Block;  

class FooterLink extends \Magento\Framework\View\Element\Html\Link
{
    public function _toHtml() 
    {
        if (
            !$this->_scopeConfig->isSetFlag('faqtab/general/enable') || 
            !$this->_scopeConfig->isSetFlag('faqtab/general/footerlink')
        ) {
            return '';
        }
        return parent::_toHtml();
    }
}
