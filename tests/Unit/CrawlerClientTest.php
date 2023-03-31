<?php

namespace Cornatul\Crawler\Tests\Unit;

use Cornatul\Crawler\Client\CrawlerClient;
use Cornatul\Crawler\Client\HtmlClient;
use Cornatul\Crawler\Dto\CrawlerDTO;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Mockery;

use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CrawlerClientTest extends \Cornatul\Crawler\Tests\TestCase
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

        $dto= $this->getMockBuilder(CrawlerDTO::class)
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



}
