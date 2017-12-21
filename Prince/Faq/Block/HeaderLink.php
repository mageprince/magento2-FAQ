<?php


namespace Prince\Faq\Block;  

class HeaderLink extends \Magento\Framework\View\Element\Html\Link
{
    public function _toHtml() 
    {
        if (
            !$this->_scopeConfig->isSetFlag('faqtab/general/enable') || 
            !$this->_scopeConfig->isSetFlag('faqtab/general/headerlink')
        ) {
            return '';
        }
        return parent::_toHtml();
    }
}
