<?php
declare(strict_types=1);
namespace Cornatul\Crawler;

use Cornatul\Crawler\Client\CrawlerClient;
use Cornatul\Crawler\Client\SentimentClient;
use Cornatul\Crawler\Commands\CrawlerCommand;
use Cornatul\Crawler\Commands\SentimentCommand;
use Cornatul\Crawler\Interfaces\CrawlerInterface;
use Cornatul\Crawler\Interfaces\SentimentInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;


class CrawlerServiceProvider extends ServiceProvider
{
    final public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'crawler');
        $this->loadRoutesFrom(__DIR__.'/../routes/crawler.php');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    final public function register(): void
    {
        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(ConsoleOutputInterface::class, ConsoleOutput::class);
        $this->app->bind(CrawlerInterface::class, CrawlerClient::class);
        $this->commands([
            CrawlerCommand::class,
        ]);

    }

}
