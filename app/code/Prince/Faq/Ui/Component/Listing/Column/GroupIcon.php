<?php


namespace Prince\Faq\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\View\Asset\Repository;

class GroupIcon extends \Magento\Ui\Component\Listing\Columns\Column
{
    private $storeManager;

    /**
     * @var \Magento\Framework\View\Asset\Repository
     */
    private $assetRepo;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param \Magento\Catalog\Helper\Image $imageHelper
     * @param \Magento\Framework\UrlInterface $urlBuilder
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storeManager,
        Repository $assetRepo,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->storeManager = $storeManager;
        $this->assetRepo = $assetRepo;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $path = $this->storeManager->getStore()->getBaseUrl(
                \Magento\Framework\UrlInterface::URL_TYPE_MEDIA
            ).'faq/tmp/icon/';

            $baseImage = $this->assetRepo->getUrl('Prince_Faq::images/faq.png');
            foreach ($dataSource['data']['items'] as & $item) {
                if ($item['icon']) {
                    $item['icon' . '_src'] = $path.$item['icon'];
                    $item['icon' . '_alt'] = $item['groupname'];
                    $item['icon' . '_orig_src'] = $path.$item['icon'];
                } else {
                    $item['icon' . '_src'] = $baseImage;
                    $item['icon' . '_alt'] = 'Faq';
                    $item['icon' . '_orig_src'] = $baseImage;
                }
            }
        }

        return $dataSource;
    }
}
