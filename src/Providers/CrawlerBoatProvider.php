<?php

namespace Cornatul\CrawlerBoat\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Cornatul\CrawlerBoat\Client\HtmlClient;
use Cornatul\CrawlerBoat\Client\SentimentClient;
use Cornatul\CrawlerBoat\Commands\HtmlExtractorCommand;
use Cornatul\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use Cornatul\CrawlerBoat\Interfaces\CrawlerInterface;
use Cornatul\CrawlerBoat\Interfaces\HtmlClientContract;
use Cornatul\CrawlerBoat\Interfaces\SentimentInterface;
use Cornatul\CrawlerBoat\Services\CrawlerConfigService;

class CrawlerBoatProvider extends ServiceProvider
{
    final public function boot(): void
    {
    }

    final public function register(): void
    {

        $this->commands([
            HtmlExtractorCommand::class
        ]);

        $this->app->bind(ClientInterface::class, Client::class);
        $this->app->bind(ConsoleOutputInterface::class, ConsoleOutput::class);
        $this->app->bind(SentimentInterface::class, SentimentClient::class);
        $this->app->bind(CrawlerInterface::class, HtmlClient::class);
    }

}
