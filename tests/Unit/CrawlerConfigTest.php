<?php

namespace UnixDevil\CrawlerBoat\Tests\Unit;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use PHPUnit\Framework\TestCase;
use Mockery;

use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\CrawlerBoat\Client\SentimentClient;
use UnixDevil\CrawlerBoat\Implementation\CrawlerConfigImplementation;
use UnixDevil\NewsBoat\Client\NewsBoat;
use UnixDevil\NewsBoat\Interfaces\AllNewsInterface;
use UnixDevil\NewsBoat\Interfaces\NewsConfigInterface;
class CrawlerConfigTest extends TestCase
{

    /**
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function testConfig()
    {
        $config =  new CrawlerConfigImplementation([
            "sentiment-endpoint" => "https://api.meaningcloud.com/sentiment-2.1",
        ]);
        $this->assertSame("https://api.meaningcloud.com/sentiment-2.1", $config->getArticleSentimentEndpoint());
    }

}
