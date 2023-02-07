<?php
/**
 * @author UnixDevil
 * @website https://unixdevil.com
 */
namespace Cornatul\CrawlerBoat\Interfaces;

use Cornatul\CrawlerBoat\DTO\SentimentDTO;

/**
 * This interface will be used to extract sentiment from a link using the Sentiment API
 * Interface SentimentInterface
 * @package UnixDevil\CrawlerBoat\Interfaces
 * @version v1.0.2
 */
interface SentimentInterface
{
    public function getSentiment(string $urlToExtract):SentimentDTO;
}

