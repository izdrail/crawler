<?php

namespace UnixDevil\CrawlerBoat\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\CrawlerBoat\Client\SentimentClient;
use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use UnixDevil\CrawlerBoat\Services\CrawlerConfigService;

class CrawlerBoatProvider extends ServiceProvider
{
    final public function boot(): void
    {
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(SentimentContract::class, SentimentClient::class);
        $this->app->bind(CrawlerConfigInterface::class, CrawlerConfigService::class);
    }

}
