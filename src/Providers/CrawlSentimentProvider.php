<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Providers;

use Cornatul\Crawler\Client\CrawlerClient;
use Cornatul\Crawler\Client\SentimentClient;
use Cornatul\Crawler\Interfaces\CrawlerInterface;
use Cornatul\Crawler\Interfaces\SentimentInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;


class CrawlSentimentProvider extends ServiceProvider
{
    final public function boot(): void
    {
    }

    final public function register(): void
    {
        $this->app->bind(SentimentInterface::class, SentimentClient::class);
    }

}
