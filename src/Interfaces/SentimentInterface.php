<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Interfaces;

use Cornatul\Crawler\Dto\SentimentDto;

/**
 * This interface will be used to extract sentiment from a link using the Sentiment API
 * Interface SentimentInterface
 * @package Cornatul\Crawler\Interfaces
 * @version v1.0.2
 */
interface SentimentInterface
{
    public function getSentiment(string $urlToExtract):SentimentDto;
}

