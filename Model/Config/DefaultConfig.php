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

namespace Mageprince\Faq\Model\Config;

class DefaultConfig
{
    /**
     * Is enabled module config path
     */
    const CONFIG_PATH_IS_ENABLE = 'faqtab/general/enable';

    /**
     * Is enable show group config path
     */
    const CONFIG_PATH_IS_SHOW_GROUP = 'faqtab/design/showgroup';

    /**
     * Is enable show group title
     */
    const CONFIG_PATH_IS_SHOW_GROUP_TITLE = 'faqtab/design/showgrouptitle';

    /**
     * Faq page type config path
     */
    const CONFIG_PATH_PAGE_TYPE = 'faqtab/design/page_type';

    /**
     * Faq url config path
     */
    const FAQ_URL_CONFIG_PATH = 'faqtab/seo/faq_url';
}
