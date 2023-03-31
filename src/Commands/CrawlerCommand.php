<?php

declare(strict_types=1);
namespace Cornatul\Crawler\Commands;

use Cornatul\Crawler\Interfaces\CrawlerInterface;
use GuzzleHttp\ClientInterface;
use Illuminate\Console\Command;
use Cornatul\Crawler\DTO\CrawlerDTO;
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


        $object = [
            "base_url" => "https://9gag.com/v1/feed-posts/type/tag/most-commented",
            "links" => [
                "https://9gag.com/v1/feed-posts/type/tag/most-commented",
                "https://9gag.com/v1/feed-posts/type/tag/most-commented?c=10",
                "https://9gag.com/v1/feed-posts/type/tag/most-commented?c=20",
                "https://9gag.com/v1/feed-posts/type/tag/most-commented?c=30",
                "https://9gag.com/v1/feed-posts/type/tag/most-commented?c=40",
            ],
            "iterator" => "data.posts",
            "fields"=> [
                "title" => "title",
                "type" => "type",
                "image" => "images.image700",
                "tags" => "tags",
                "comments" => "commentsCount",
            ],
        ];


        $htmlStructure = CrawlerDTO::from($object);

        $results = $htmlClientContract->extract($htmlStructure);

    }
}
