<?php

namespace Cornatul\CrawlerBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Mockery;

use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnixDevil\Crawler\Contracts\SentimentContract;
use Cornatul\CrawlerBoat\Client\HtmlClient;
use Cornatul\CrawlerBoat\Client\SentimentClient;
use Cornatul\CrawlerBoat\DTO\HtmlDTO;
use Cornatul\CrawlerBoat\DTO\SentimentDTO;
use Cornatul\CrawlerBoat\Interfaces\CrawlerConfigInterface;
class HtmlTest extends \Cornatul\CrawlerBoat\Tests\TestCase
{

    /**
     * @throws GuzzleException
     */
    public function testHtmlClient()
    {
        //generate a unit test for the HtmlClient

        $sentiment= $this->getMockBuilder(HtmlDTO::class)
            ->getMock();



        //generate a test for the sentiment client
        $mock = $this->getMockBuilder(HtmlClient::class)
            ->setConstructorArgs([Mockery::mock(ClientInterface::class), Mockery::mock(ConsoleOutputInterface::class)])
            ->getMock();
        $mock->method('extract')
            ->with($sentiment)
            ->willReturn([]);
        $this->assertSame([], $mock->extract($sentiment));
    }
}
