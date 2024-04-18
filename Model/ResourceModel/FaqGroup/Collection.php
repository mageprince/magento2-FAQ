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

namespace Mageprince\Faq\Model\ResourceModel\FaqGroup;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mageprince\Faq\Model\FaqGroup as FaqGroupModel;
use Mageprince\Faq\Model\ResourceModel\FaqGroup as FaqGroupResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    public $_idFieldName = 'faqgroup_id';

    /**
     * Define resource model
     *
     * @return void
     */
    public function _construct()
    {
        $this->_init(
            FaqGroupModel::class,
            FaqGroupResourceModel::class
        );
    }

    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('faqgroup_id', 'groupname');
    }
}
