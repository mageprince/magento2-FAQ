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

namespace Mageprince\Faq\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PageType implements OptionSourceInterface
{
    const SCROLL = 'scroll';
    const AJAX = 'ajax';

    /**
     * Get page type
     *
     * @return array
     */
    public function toOptionArray()
    {
        return  [
            ['value' => self::SCROLL, 'label' => 'Scroll'],
            ['value' => self::AJAX, 'label' => 'Ajax']
        ];
    }
}
