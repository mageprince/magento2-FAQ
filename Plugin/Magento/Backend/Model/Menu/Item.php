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

namespace Mageprince\Faq\Plugin\Magento\Backend\Model\Menu;

class Item
{
    /**
     * @param $subject
     * @param $result
     * @return string
     */
    public function afterGetUrl($subject, $result)
    {
        $menuId = $subject->getId();
        
        if ($menuId == 'Mageprince_Faq::faq_user_guid') {
            $result = 'https://marketplace.magento.com/media/catalog/product/prince-module-faq-2-0-1-ce/user_guides.pdf';
        } elseif ($menuId == 'Mageprince_Faq::other_modules') {
            $result = 'http://mageprince.com/blog/modules';
        }
        
        return $result;
    }
}
