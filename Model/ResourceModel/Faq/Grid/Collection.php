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

namespace Mageprince\Faq\Model\ResourceModel\Faq\Grid;

use Magento\Framework\View\Element\UiComponent\DataProvider\SearchResult;

class Collection extends SearchResult
{
    /**
     * @var string[]
     */
    protected $multiselectFields = [
        'group',
        'storeview',
        'customer_group'
    ];

    /**
     * Apply finset filters for CSV-backed multiselect fields.
     *
     * @param string|array $field
     * @param null|string|array $condition
     * @return $this
     */
    public function addFieldToFilter($field, $condition = null)
    {
        if (is_string($field) && in_array($field, $this->multiselectFields, true)) {
            $value = $this->getFilterValue($condition);
            if ($value === null || $value === '') {
                return $this;
            }

            return parent::addFieldToFilter($field, ['finset' => $value]);
        }

        return parent::addFieldToFilter($field, $condition);
    }

    /**
     * Retrieve selected UI filter value from condition array.
     *
     * @param mixed $condition
     * @return mixed
     */
    private function getFilterValue($condition)
    {
        if (is_array($condition)) {
            if (isset($condition['eq'])) {
                return $condition['eq'];
            }
            if (isset($condition['finset'])) {
                return $condition['finset'];
            }
            if (isset($condition['in']) && is_array($condition['in'])) {
                return reset($condition['in']);
            }
        }

        return $condition;
    }
}
