<?php

namespace Cornatul\Crawler\Client;
use Crwlr\Crawler\Exceptions\UnknownLoaderKeyException;
use Crwlr\Crawler\HttpCrawler;
use Crwlr\Crawler\Steps\Html;
use Crwlr\Crawler\Steps\Loading\Http;
use Crwlr\Crawler\UserAgents\BotUserAgent;
use Crwlr\Crawler\UserAgents\UserAgentInterface;
use Cornatul\Crawler\Dto\CrawlerDTO;
use Illuminate\Support\Collection;
use Cornatul\Crawler\Interfaces\CrawlerInterface;
use Spatie\LaravelData\Data;

class HtmlClient extends HttpCrawler implements CrawlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function userAgent(): UserAgentInterface
    {
        return BotUserAgent::make('HtmlClient');
    }

    /**
     * @throws UnknownLoaderKeyException
     * @throws \Exception
     */
    public function extract(CrawlerDTO|Data $dto): Collection
    {
        $results = new Collection();

        $this->input($dto->base_url)
            ->addStep(Http::get())                              // Load the listing page
            ->addStep(Html::getLinks($dto->iterator))    // Get the links to the articles
            ->addStep(Http::get())                              // Load the article pages
            ->addStep(
                Html::first('article')->extract($dto->fields)->addToResult()
            );

        return collect($this->run());
    }
}
