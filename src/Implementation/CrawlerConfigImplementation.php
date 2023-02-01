<?php

namespace UnixDevil\CrawlerBoat\Implementation;

use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;

class CrawlerConfigImplementation implements CrawlerConfigInterface
{


    private array $config;

    public  function __construct(array $config)
    {
        //assign config by
        $this->config = $config;
    }

    public function getArticleSentimentEndpoint():string
    {
        return $this->config['sentiment-endpoint'];
    }
}
