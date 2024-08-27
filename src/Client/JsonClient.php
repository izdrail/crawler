<?php

namespace Cornatul\Crawler\Client;

use Crwlr\Crawler\Exceptions\UnknownLoaderKeyException;
use Crwlr\Crawler\HttpCrawler;
use Crwlr\Crawler\Steps\Json;
use Crwlr\Crawler\Steps\Loading\Http;
use Crwlr\Crawler\UserAgents\BotUserAgent;
use Crwlr\Crawler\UserAgents\UserAgentInterface;
use Cornatul\Crawler\Dto\CrawlerDTO;
use Illuminate\Support\Collection;
use Cornatul\Crawler\Interfaces\CrawlerInterface;

class JsonClient extends HttpCrawler implements CrawlerInterface
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function userAgent(): UserAgentInterface
    {
        return new BotUserAgent('MyBot', 'https://www.example.com/my-bot', '1.2');
    }



    /**
     * @throws UnknownLoaderKeyException
     * @throws \Exception
     */
    public function extract(CrawlerDTO $dto): Collection
    {
        $this->inputs($dto->links)
            ->addStep(Http::get())
            ->addStep(
                Json::each($dto->iterator, $dto->fields)
            );

        return collect($this->run());
    }
}
