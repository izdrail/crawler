<?php

namespace Cornatul\CrawlerBoat\Facades;
use Illuminate\Support\Facades\Config;
class CrawlerConfig
{
    public static function getSentimentEndpoint(): string
    {
        return Config::get('crawler-boat.sentiment-endpoint');
    }
}
