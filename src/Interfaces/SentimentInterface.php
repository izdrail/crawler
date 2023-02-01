<?php

namespace UnixDevil\CrawlerBoat\Interfaces;

use UnixDevil\Crawler\DTO\NLPArticleSentimentDTO;
use UnixDevil\CrawlerBoat\DTO\SentimentDTO;

interface SentimentInterface
{
    public function getSentiment(string $urlToExtract):SentimentDTO;
}

