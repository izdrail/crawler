<?php namespace UnixDevil\CrawlerBoat\Commands;

use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use UnixDevil\CrawlerBoat\DTO\HtmlDTO;
use UnixDevil\CrawlerBoat\Interfaces\HtmlClientContract;
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
    final public function handle(ClientInterface $client, HtmlClientContract $htmlClientContract): void
    {
        $this->output->success('Welcome to the package crawler command!');

        $links = [
            'it' => 'https://www.cv-library.co.uk/it-jobs?perpage=100',
        ];

        $object = [
            'base_url' => 'https://www.cv-library.co.uk',
            "links" => $links,
            "iterator" => "h2.job__title > a",
            "fields"=> [
                "title" => "h1.job__title > span",
                "body" => "div.job__description",
                "url" => "",
                "category" => "",
                "image" => "img.job__logo",
            ],
        ];


        $htmlStructure = HtmlDTO::from($object);

        $data = $htmlClientContract->extract($htmlStructure);
        dd($data);
    }



}
