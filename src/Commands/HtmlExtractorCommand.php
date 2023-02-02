<?php namespace UnixDevil\CrawlerBoat\Commands;

use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use UnixDevil\CrawlerBoat\Interfaces\SentimentInterface;


class HtmlExtractorCommand extends Command
{
    /**
     * @var string The console command name.
     */
    protected static $defaultName = 'crawler:extract';

    /**
     * @var string The name and signature of this command.
     */
    protected $signature = 'crawler:extract';

    /**
     * @var string The console command description.
     */
    protected $description = 'This will extract content from a html page using a json structure';

    /**
     * Execute the console command.
     * @param ClientInterface $client
     * @return void
     */
    final public function handle(ClientInterface $client): void
    {
        $this->output->success('Welcome!');
    }



}
