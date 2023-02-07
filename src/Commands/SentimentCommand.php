<?php namespace Cornatul\Crawler\Commands;

use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use Cornatul\Crawler\Dto\HtmlDto;
use Cornatul\Crawler\Interfaces\SentimentInterface;
use JsonException;


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
    protected $description = 'This will extract the whole text and sentiment of that text from a  given url';

    /**
     * Execute the console command.
     * @param ClientInterface $client
     * @param SentimentInterface $sentiment
     * @return void
     * @throws JsonException
     */
    final public function handle(ClientInterface $client, SentimentInterface $sentiment): void
    {
        $this->output->success('Welcome to the package crawler command!');

        $url = $this->argument('url');

        $result = $sentiment->getSentiment($url);

        $this->output->success(json_encode($result, JSON_THROW_ON_ERROR));
    }



}
