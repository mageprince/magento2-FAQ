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

namespace Mageprince\Faq\Ui\Component\Listing\Column;

use Magento\Framework\Data\OptionSourceInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Mageprince\Faq\Ui\Component\Listing\Options\CustomerGroup as CustomerGroupOptions;

class CustomerGroup extends Column implements OptionSourceInterface
{
    /**
     * @var CustomerGroupOptions
     */
    protected $customerGroupOptions;

    /**
     * @var array|null
     */
    protected $options;

    /**
     * CustomerGroup constructor.
     *
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param CustomerGroupOptions $customerGroupOptions
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        CustomerGroupOptions $customerGroupOptions,
        array $components = [],
        array $data = []
    ) {
        $this->customerGroupOptions = $customerGroupOptions;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Options getter
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->customerGroupOptions->toOptionArray();
    }

    /**
     * Prepare grid data source.
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as &$item) {
                if (isset($item[$this->getData('name')])) {
                    $item[$this->getData('name')] = $this->renderLabels($item[$this->getData('name')]);
                }
            }
        }

        return $dataSource;
    }

    /**
     * Render CSV values as labels.
     *
     * @param string|array $value
     * @return string
     */
    private function renderLabels($value)
    {
        $options = $this->getOptionsMap();
        $labels = [];
        foreach ($this->splitValue($value) as $id) {
            $labels[] = $options[$id] ?? $id;
        }

        return implode(', ', $labels);
    }

    /**
     * Retrieve option labels keyed by value.
     *
     * @return array
     */
    private function getOptionsMap()
    {
        if ($this->options === null) {
            $this->options = [];
            foreach ($this->toOptionArray() as $option) {
                $this->options[(string)$option['value']] = (string)$option['label'];
            }
        }

        return $this->options;
    }

    /**
     * Split CSV or array values.
     *
     * @param string|array $value
     * @return array
     */
    private function splitValue($value)
    {
        if (is_array($value)) {
            return $value;
        }

        return array_filter(explode(',', (string)$value), 'strlen');
    }
}
