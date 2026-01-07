<?php

namespace Mageprince\Faq\Model\Resolver;

use Magento\Framework\Data\Collection as AbstractDbCollection;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Mageprince\Faq\Model\ResourceModel\Faq\CollectionFactory as FaqCollectionFactory;

class Faq implements ResolverInterface
{
    /**
     * @var FaqCollectionFactory
     */
    protected $faqCollectionFactory;

    /**
     * Faq constructor.
     * @param FaqCollectionFactory $faqCollectionFactory
     */
    public function __construct(
        FaqCollectionFactory $faqCollectionFactory
    ) {
        $this->faqCollectionFactory = $faqCollectionFactory;
    }

    /**
     * @inheritdoc
     */
    public function resolve(
        Field $field,
        $context,
        ResolveInfo $info,
        ?array $value = null,
        ?array $args = null
    ) {
        if (isset($args['pageSize']) && $args['pageSize'] < 1) {
            throw new GraphQlInputException(__('pageSize value must be greater than 0.'));
        }

        if (isset($args['currentPage']) && $args['currentPage'] < 1) {
            throw new GraphQlInputException(__('currentPage value must be greater than 0.'));
        }

        /** @var \Mageprince\Faq\Model\ResourceModel\Faq\Collection $faqCollection */
        $faqCollection = $this->faqCollectionFactory->create();

        if (!empty($args['groupId'])) {
            $faqCollection->addFieldToFilter(
                'group',
                [
                    ['null' => true],
                    ['finset' => $args['groupId']]
                ]
            );
        }

        $faqCollection->addFieldToFilter('status', 1);
        $faqCollection->setOrder('sortorder', AbstractDbCollection::SORT_ORDER_ASC);

        if (isset($args['pageSize'])) {
            $faqCollection->setPageSize($args['pageSize']);
        }

        if (isset($args['currentPage'])) {
            $faqCollection->setCurPage($args['currentPage']);
        }

        return $faqCollection->getData();
    }
}
