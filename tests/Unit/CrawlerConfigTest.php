<?php

namespace UnixDevil\CrawlerBoat\Tests\Unit;


use Mockery;

use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\CrawlerBoat\Client\SentimentClient;

use UnixDevil\CrawlerBoat\Services\CrawlerConfigService;
use UnixDevil\NewsBoat\Client\NewsBoat;
use UnixDevil\NewsBoat\Interfaces\AllNewsInterface;
use UnixDevil\NewsBoat\Interfaces\NewsConfigInterface;
class CrawlerConfigTest extends \UnixDevil\CrawlerBoat\Tests\TestCase
{

    /**
     * @throws \JsonException
     * @throws GuzzleException
     */
    public function testConfig()
    {
        $config =  new CrawlerConfigService([
            "sentiment-endpoint" => "https://api.meaningcloud.com/sentiment-2.1",
        ]);
        $this->assertSame("https://api.meaningcloud.com/sentiment-2.1", $config->getArticleSentimentEndpoint());
    }

}
