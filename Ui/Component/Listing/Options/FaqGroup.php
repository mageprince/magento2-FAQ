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

namespace Mageprince\Faq\Ui\Component\Listing\Options;

use Magento\Framework\Data\OptionSourceInterface;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory;

class FaqGroup implements OptionSourceInterface
{
    /**
     * @var CollectionFactory
     */
    private $groupCollectionFactory;

    /**
     * FaqGroup constructor.
     *
     * @param CollectionFactory $groupCollectionFactory
     */
    public function __construct(
        CollectionFactory $groupCollectionFactory
    ) {
        $this->groupCollectionFactory = $groupCollectionFactory;
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = [];
        foreach ($this->groupCollectionFactory->create() as $group) {
            $options[] = [
                'value' => (string)$group->getFaqGroupId(),
                'label' => (string)__($group->getGroupname())
            ];
        }

        return $options;
    }
}
