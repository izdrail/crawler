<?php

namespace UnixDevil\CrawlerBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Mockery;

use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\CrawlerBoat\Client\HtmlClient;
use UnixDevil\CrawlerBoat\Client\SentimentClient;
use UnixDevil\CrawlerBoat\DTO\HtmlDTO;
use UnixDevil\CrawlerBoat\DTO\SentimentDTO;
use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use UnixDevil\NewsBoat\Client\NewsBoat;
use UnixDevil\NewsBoat\Interfaces\AllNewsInterface;
use UnixDevil\NewsBoat\Interfaces\NewsConfigInterface;
class HtmlTest extends \UnixDevil\CrawlerBoat\Tests\TestCase
{

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
