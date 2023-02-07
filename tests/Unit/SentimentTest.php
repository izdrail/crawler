<?php

namespace Cornatul\CrawlerBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Mockery;

use Cornatul\Crawler\Interfaces\SentimentInterface;
use Cornatul\Crawler\Client\SentimentClient;
use Cornatul\Crawler\Dto\SentimentDto;

class SentimentTest extends \Cornatul\CrawlerBoat\Tests\TestCase
{

    /**
     * @throws JsonException|GuzzleException
     */
    final public function testGetSentiment():void
    {

        $sentiment= $this->getMockBuilder(SentimentDto::class)
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
