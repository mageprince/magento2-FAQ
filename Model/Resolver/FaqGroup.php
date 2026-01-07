<?php

namespace Mageprince\Faq\Model\Resolver;

use Magento\Framework\Data\Collection as AbstractDbCollection;
use Magento\Framework\GraphQl\Config\Element\Field;
use Magento\Framework\GraphQl\Exception\GraphQlInputException;
use Magento\Framework\GraphQl\Query\ResolverInterface;
use Magento\Framework\GraphQl\Schema\Type\ResolveInfo;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageprince\Faq\Model\Config\DefaultConfig;
use Mageprince\Faq\Model\ResourceModel\FaqGroup\CollectionFactory as FaqGroupCollectionFactory;

class FaqGroup implements ResolverInterface
{
    /**
     * @var FaqGroupCollectionFactory
     */
    protected $faqGroupCollectionFactory;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * FaqGroup constructor.
     * @param FaqGroupCollectionFactory $faqGroupCollectionFactory
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        FaqGroupCollectionFactory $faqGroupCollectionFactory,
        StoreManagerInterface $storeManager
    ) {
        $this->faqGroupCollectionFactory = $faqGroupCollectionFactory;
        $this->storeManager = $storeManager;
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

        /** @var \Mageprince\Faq\Model\ResourceModel\FaqGroup\Collection $faqGroupCollection */
        $faqGroupCollection = $this->faqGroupCollectionFactory->create();
        $faqGroupCollection->addFieldToFilter('status', 1);
        $faqGroupCollection->setOrder('sortorder', AbstractDbCollection::SORT_ORDER_ASC);

        if (isset($args['pageSize'])) {
            $faqGroupCollection->setPageSize($args['pageSize']);
        }

        if (isset($args['currentPage'])) {
            $faqGroupCollection->setCurPage($args['currentPage']);
        }

        $groups = $faqGroupCollection->getData();
        foreach ($groups as $key => $group) {
            if ($icon = $group['icon']) {
                $groups[$key]['icon'] = $this->getGroupIcon($icon);
            }
        }

        return $groups;
    }

    /**
     * Retrieve group icon url
     *
     * @param string $icon
     * @return string
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getGroupIcon($icon)
    {
        $mediaUrl = $this->storeManager
            ->getStore()
            ->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        return $mediaUrl . DefaultConfig::ICON_TMP_PATH . $icon;
    }
}
