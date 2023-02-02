<?php

namespace UnixDevil\CrawlerBoat\Providers;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Output\ConsoleOutput;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use UnixDevil\CrawlerBoat\Client\HtmlClient;
use UnixDevil\CrawlerBoat\Client\SentimentClient;
use UnixDevil\CrawlerBoat\Commands\HtmlExtractorCommand;
use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use UnixDevil\CrawlerBoat\Interfaces\HtmlClientContract;
use UnixDevil\CrawlerBoat\Interfaces\SentimentInterface;
use UnixDevil\CrawlerBoat\Services\CrawlerConfigService;

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
        $this->app->bind(HtmlClientContract::class, HtmlClient::class);
        $this->app->bind(CrawlerConfigInterface::class, CrawlerConfigService::class);
    }

}
