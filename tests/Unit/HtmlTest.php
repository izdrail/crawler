<?php

namespace Cornatul\Crawler\Tests\Unit;

use Cornatul\Crawler\Client\CrawlerClient;
use Cornatul\Crawler\Dto\HtmlDto;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Mockery;

use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class HtmlTest extends \Cornatul\Crawler\Tests\TestCase
{

    /**
     * @throws GuzzleException
     */
    final public function testHtmlClient(): void
    {
        //generate a unit test for the HtmlClient

        $sentiment= $this->getMockBuilder(HtmlDto::class)
            ->getMock();



        //generate a test for the sentiment client
        $mock = $this->getMockBuilder(CrawlerClient::class)
            ->setConstructorArgs([Mockery::mock(ClientInterface::class), Mockery::mock(ConsoleOutputInterface::class)])
            ->getMock();
        $mock->method('extract')
            ->with($sentiment)
            ->willReturn([]);
        $this->assertSame([], $mock->extract($sentiment));
    }
}
