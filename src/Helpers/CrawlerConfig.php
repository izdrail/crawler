<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Helpers;
use Illuminate\Support\Facades\Config;


/**
 * Class CrawlerConfig
 */
class CrawlerConfig
{
    public static function getSentimentEndpoint(): string
    {
        return config('crawler.sentiment-endpoint');
    }
}
