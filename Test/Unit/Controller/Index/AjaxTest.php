<?php
declare(strict_types=1);

namespace Mageprince\Faq\Test\Unit\Controller\Index;

use Magento\Framework\App\Action\Context;
use Magento\Framework\App\CacheInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\Controller\Result\Json;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\View\LayoutInterface;
use Magento\Framework\View\Result\Page;
use Magento\Framework\View\Result\PageFactory;
use Magento\Store\Api\Data\StoreInterface;
use Magento\Store\Model\StoreManagerInterface;
use Mageprince\Faq\Block\Index\Index as FaqBlock;
use Mageprince\Faq\Controller\Index\Ajax;
use Mageprince\Faq\Helper\Data;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class AjaxTest extends TestCase
{
    /**
     * @var CacheInterface|MockObject
     */
    private $cache;

    /**
     * @var Data|MockObject
     */
    private $helper;

    /**
     * @var StoreManagerInterface|MockObject
     */
    private $storeManager;

    /**
     * @var Http|MockObject
     */
    private $request;

    /**
     * @var FaqBlock|MockObject
     */
    private $block;

    /**
     * @var Ajax
     */
    private $controller;

    protected function setUp(): void
    {
        $this->request = $this->createStub(Http::class);
        $this->request->method('isXmlHttpRequest')->willReturn(true);
        $this->request->method('getParam')->willReturnMap([
            ['groupId', null, '3'],
            ['hyva', null, null],
        ]);

        $context = $this->createStub(Context::class);
        $context->method('getRequest')->willReturn($this->request);

        $this->block = $this->getMockBuilder(FaqBlock::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['setTemplate', 'toHtml'])
            ->getMock();
        $this->block->method('setTemplate')->willReturnSelf();
        $this->block->method('toHtml')->willReturn('<div>faq</div>');

        $layout = $this->createStub(LayoutInterface::class);
        $layout->method('createBlock')->willReturn($this->block);
        $page = $this->createStub(Page::class);
        $page->method('getLayout')->willReturn($layout);
        $pageFactory = $this->createStub(PageFactory::class);
        $pageFactory->method('create')->willReturn($page);

        $jsonFactory = $this->createStub(JsonFactory::class);
        $jsonFactory->method('create')->willReturn($this->createStub(Json::class));

        $this->cache = $this->createMock(CacheInterface::class);
        $this->helper = $this->createStub(Data::class);
        $this->storeManager = $this->createStub(StoreManagerInterface::class);

        $this->controller = new Ajax(
            $context,
            $this->helper,
            $pageFactory,
            $jsonFactory,
            $this->cache,
            $this->storeManager
        );
    }

    #[DataProvider('contextProvider')]
    public function testCacheKeyDiffersPerStoreAndCustomerGroup(
        int $storeId,
        int $customerGroupId,
        string $expectedKey
    ): void {
        $store = $this->createStub(StoreInterface::class);
        $store->method('getId')->willReturn($storeId);
        $this->storeManager->method('getStore')->willReturn($store);
        $this->helper->method('getCustomerGroupId')->willReturn($customerGroupId);

        $this->cache->expects($this->once())->method('load')->with($expectedKey)->willReturn(false);
        $this->cache->expects($this->once())->method('save')->with(
            '<div>faq</div>',
            $expectedKey,
            $this->anything()
        );

        $this->controller->execute();
    }

    public function testCachedHtmlIsServedOnlyForMatchingContext(): void
    {
        $store = $this->createStub(StoreInterface::class);
        $store->method('getId')->willReturn(2);
        $this->storeManager->method('getStore')->willReturn($store);
        $this->helper->method('getCustomerGroupId')->willReturn(1);

        $this->cache->method('load')->willReturnCallback(
            static fn (string $key) => $key === 'mageprince_faq_group_3_store_1_customer_group_0'
                ? '<p>cached</p>'
                : false
        );
        $this->cache->expects($this->once())->method('save');

        $this->controller->execute();
    }

    public static function contextProvider(): array
    {
        return [
            'default store, guest' => [1, 0, 'mageprince_faq_group_3_store_1_customer_group_0'],
            'other store view, guest' => [2, 0, 'mageprince_faq_group_3_store_2_customer_group_0'],
            'default store, general group' => [1, 1, 'mageprince_faq_group_3_store_1_customer_group_1'],
        ];
    }
}
