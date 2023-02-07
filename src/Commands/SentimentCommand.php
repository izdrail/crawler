<?php namespace Cornatul\CrawlerBoat\Commands;

use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use UnixDevil\CrawlerBoat\DTO\HtmlDTO;
use Cornatul\CrawlerBoat\Interfaces\HtmlClientContract;
use Cornatul\CrawlerBoat\Interfaces\SentimentInterface;


class SentimentCommand extends Command
{
    /**
     * @var string The console command name.
     */
    protected static $defaultName = 'crawler:sentiment {url}';

    /**
     * @var string The name and signature of this command.
     */
    protected $signature = 'crawler:sentiment {url}';

    /**
     * @var string The console command description.
     */
    protected $description = 'This will extract the sentiment from a url';

    /**
     * Execute the console command.
     * @param ClientInterface $client
     * @return void
     */
    final public function handle(ClientInterface $client, SentimentInterface $sentiment): void
    {
        $this->output->success('Welcome to the package crawler command!');

        $url = $this->argument('url');

        $sentiment = $sentiment->getSentiment($url);

        dd($sentiment);
    }



}
