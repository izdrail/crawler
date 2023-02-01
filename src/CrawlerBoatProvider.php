<?php

namespace UnixDevil\CrawlerBoat;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\CrawlerBoat\Client\SentimentClient;
use UnixDevil\CrawlerBoat\Implementation\CrawlerConfigImplementation;
use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;

class CrawlerBoatProvider extends ServiceProvider
{
    final public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/Config/news-boat.php' => \UnixDevil\CrawlerBoat\config_path('crawler-boat.php'),
        ]);
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(SentimentContract::class, SentimentClient::class);
        $this->app->bind(CrawlerConfigInterface::class, CrawlerConfigImplementation::class);

    }
}
