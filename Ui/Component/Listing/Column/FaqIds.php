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

namespace Mageprince\Faq\Ui\Component\Listing\Column;

class FaqIds implements \Magento\Framework\Option\ArrayInterface
{
    private $faqCollection;

    public function __construct(
        \Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory $faqCollection
    ) {
        $this->faqCollection = $faqCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $faqArr = [];
        $faqs = $this->faqCollection->create();

        foreach ($faqs as $faq) {
            $faqArr[] = ['value' => $faq->getFaqId(), 'label' => __($faq->getTitle())];
        }

        return $faqArr;
    }
}
