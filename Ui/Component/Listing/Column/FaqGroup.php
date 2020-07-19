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

use Magento\Framework\Data\OptionSourceInterface;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory;

class FaqGroup implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $groupCollection;

    /**
     * FaqGroup constructor.
     *
     * @param CollectionFactory $groupCollection
     */
    public function __construct(
        CollectionFactory $groupCollection
    ) {
        $this->groupCollection = $groupCollection;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $groupArr = [];
        $groups = $this->groupCollection->create();

        foreach ($groups as $group) {
            $groupArr[] = ['value' => $group->getFaqgroupId(), 'label' => __($group->getGroupname())];
        }

        return $groupArr;
    }
}
