<?php

namespace Cornatul\CrawlerBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Mockery;

use Cornatul\Crawler\Contracts\SentimentContract;
use Cornatul\CrawlerBoat\Client\SentimentClient;
use Cornatul\CrawlerBoat\DTO\SentimentDTO;
use Cornatul\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use Cornatul\NewsBoat\Client\NewsBoat;
use Cornatul\NewsBoat\Interfaces\AllNewsInterface;
use Cornatul\NewsBoat\Interfaces\NewsConfigInterface;
class SentimentTest extends \Cornatul\CrawlerBoat\Tests\TestCase
{

    /**
     * @throws JsonException|GuzzleException
     */
    final public function testGetSentiment():void
    {

        $sentiment= $this->getMockBuilder(SentimentDTO::class)
            ->getMock();

        $mock = $this->getMockBuilder(SentimentClient::class)
            ->setConstructorArgs
            (
                [
                Mockery::mock(ClientInterface::class),
                Mockery::mock(ConsoleOutputInterface::class)
                ]
            )
            ->getMock();
        $mock->method('getSentiment')
            ->with('https://v1.nlpapi.org')
            ->willReturn($sentiment);

        $this->assertSame($sentiment, $mock->getSentiment('https://v1.nlpapi.org'));

    }

}
