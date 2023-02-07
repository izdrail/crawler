<?php namespace Cornatul\Crawler\Commands;

use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use Cornatul\Crawler\Dto\HtmlDto;
use Cornatul\Crawler\Interfaces\SentimentInterface;


class CrawlerCommand extends Command
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
    protected $description = 'This will extract content from a website page using a array structure';

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

        //todo to change this have a look at how you can preprocess the data that enters in the DTO
        $object = [
            'base_url' => 'https://www.cv-library.co.uk',
            "links" => $links,
            "iterator" => "h2.job__title > a",
            "fields"=> [
                "title" => "h1.job__title > span",
                "body" => "div.job__description",
                "image" => "img.job__logo",
            ],
        ];


        $htmlStructure = HtmlDto::from($object);

        $data = $htmlClientContract->extract($htmlStructure);

        $this->output->success($data);
    }



}
