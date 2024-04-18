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

namespace Mageprince\Faq\Model\Config;

class DefaultConfig
{
    /**
     * FAQ module config paths
     */
    public const CONFIG_PATH_IS_ENABLE = 'faqtab/general/enable';
    public const CONFIG_PATH_PAGE_TITLE = 'faqtab/general/page_title';
    public const CONFIG_PATH_IS_SHOW_GROUP = 'faqtab/design/showgroup';
    public const CONFIG_PATH_IS_SHOW_GROUP_TITLE = 'faqtab/design/showgrouptitle';
    public const CONFIG_PATH_PAGE_TYPE = 'faqtab/design/page_type';
    public const CONFIG_PATH_FOOTER_LINK = 'faqtab/design/footerlink';
    public const CONFIG_PATH_HEADER_LINK = 'faqtab/design/headerlink';
    public const CONFIG_PATH_IS_ENABLED_COLLAPSE_EXPAND = 'faqtab/design/is_collapse_expand';
    public const FAQ_URL_CONFIG_PATH = 'faqtab/seo/faq_url';
    public const FAQ_META_TITLE = 'faqtab/seo/meta_title';
    public const FAQ_META_KEYWORD = 'faqtab/seo/meta_keywords';
    public const FAQ_META_DESCRIPTION = 'faqtab/seo/meta_description';

    /**
     * Faq group icon image path
     */
    public const ICON_TMP_PATH = 'faq/tmp/icon/';

    /**
     * Faq page render types
     */
    public const FAQ_PAGE_TYPE_AJAX = 'ajax';
    public const FAQ_PAGE_TYPE_SCROLL = 'scroll';

    /**
     * Ajax url for faq
     */
    public const FAQ_PAGE_AJAX_URL = 'faq/index/ajax';

    /**
     * FAQ template files
     */
    public const FAQ_MAIN_TEMPLATE_FILE = 'Mageprince_Faq::faq_main.phtml';
    public const FAQ_AJAX_TEMPLATE_FILE = 'Mageprince_Faq::faq_ajax.phtml';
}
