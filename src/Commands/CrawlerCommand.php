<?php

declare(strict_types=1);
namespace Cornatul\Crawler\Commands;

use Cornatul\Crawler\Interfaces\CrawlerInterface;
use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use Cornatul\Crawler\Dto\HtmlDTO;
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
    final public function handle(ClientInterface $client, CrawlerInterface $htmlClientContract): void
    {
        $this->output->success('Welcome to the package crawler command!');

        $links = [
            'brake-system' => 'https://club.autodoc.co.uk/manuals/brake-system/brake-discs/all',
        ];

        $object = [
            'base_url' => 'https://club.autodoc.co.uk',
            "links" => $links,
            "iterator" => "div.pdf-instruction-item__header > div > a",
            "fields"=> [
                "title" => "h1.section__title-category",
                "body" => "div.sub-page--instruction",
                "image" => "div.details-image > div.seo-tool__container > img",
            ],
        ];


        $htmlStructure = HtmlDTO::from($object);

        $htmlClientContract->extract($htmlStructure);

    }



}
