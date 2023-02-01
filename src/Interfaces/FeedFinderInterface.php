<?php

namespace UnixDevil\CrawlerBoat\Interfaces;

use UnixDevil\Crawler\DTO\NLPArticleSentimentDTO;
use UnixDevil\CrawlerBoat\DTO\SentimentDTO;

interface FeedFinderInterface
{
    public function getFeed(string $urlToExtract):SentimentDTO;
}

