<?php

namespace Cornatul\Crawler\Helpers;
use Illuminate\Support\Facades\Config;

/**
 * @todo Move this to a helper and not an facade
 */
class CrawlerConfig
{
    public static function getSentimentEndpoint(): string
    {
        return Config::get('crawler.sentiment-endpoint');
    }
}
