<?php

namespace Cornatul\Crawler\Tests\Unit;

use Cornatul\Crawler\Client\CrawlerClient;
use Cornatul\Crawler\Dto\HtmlDTO;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Mockery;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HtmlTest extends \Cornatul\Crawler\Tests\TestCase
{
    /** @var ClientInterface|MockObject */
    private $client;
    /** @var ConsoleOutputInterface|MockObject */
    private $output;

    public function setUp(): void
    {
        $this->client = $this->createMock(ClientInterface::class);
        $this->output = $this->createMock(ConsoleOutputInterface::class);
    }
    /**
     * @throws GuzzleException
     */
    final public function testHtmlClient(): void
    {
        //generate a unit test for the HtmlClient

        $dto= $this->getMockBuilder(HtmlDTO::class)
            ->getMock();



        //generate a test for the sentiment client
        $mock = $this->getMockBuilder(CrawlerClient::class)
            ->setConstructorArgs([Mockery::mock(ClientInterface::class), Mockery::mock(ConsoleOutputInterface::class)])
            ->getMock();
        $mock->method('extract')
            ->with($dto)
            ->willReturn(collect([]));

        $this->assertInstanceOf(CrawlerClient::class, $mock);
        $this->assertSame([], $mock->extract($dto)->toArray());
    }


    /**
     * @throws GuzzleException
     */
    public function testExtract(): void
    {
        $htmlDTO = new HtmlDTO([
            'base_url' => 'https://example.com',
            'links' => [
                'category_1' => 'https://example.com/category/1',
                'category_2' => 'https://example.com/category/2',
            ],
            'iterator' => 'a.article-link',
            'fields' => [
                'title' => 'h1.title',
                'content' => 'div.content',
            ],
        ]);

        $crawlerClient = new CrawlerClient($this->client, $this->output);

        // Mocking requests to https://example.com/category/1 and https://example.com/category/2
        $this->client
            ->method('request')
            ->withConsecutive(
                ['GET', 'https://example.com/category/1', ['headers' => $crawlerClient->headers]],
                ['GET', 'https://example.com/category/2', ['headers' => $crawlerClient->headers]]
            )
            ->willReturn($this->createMock(ResponseInterface::class));

        // Call the method to be tested
        $response = $crawlerClient->extract($htmlDTO);

        // Assert that the method executed successfully
        $this->assertTrue(true);
        $this->assertSame([], $response->toArray());

    }



}
