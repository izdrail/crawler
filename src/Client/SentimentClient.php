<?php

namespace UnixDevil\CrawlerBoat\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Config;
use JsonException;
use UnixDevil\Crawler\Contracts\SentimentContract;
use UnixDevil\Crawler\DTO\FeedFinderDTO;
use UnixDevil\Crawler\DTO\NLPArticleSentimentDTO;
use UnixDevil\Crawler\DTO\NlpDTO;
use UnixDevil\CrawlerBoat\DTO\SentimentDTO;
use UnixDevil\CrawlerBoat\Interfaces\CrawlerConfigInterface;
use UnixDevil\CrawlerBoat\Interfaces\SentimentInterface;


/**
 * @class SentimentClient
 */
class SentimentClient implements SentimentInterface
{

    private CrawlerConfigInterface $config;
    private ClientInterface $client;

    public function __construct(ClientInterface $client, CrawlerConfigInterface $config)
    {
        $this->client = $client;
        $this->config = $config;
    }


    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getSentiment(string $urlToExtract): SentimentDTO
    {
        //
        $response = $this->client->post($this->config->getArticleSentimentEndpoint(), [
            'json' => [
                'link' => $urlToExtract
            ]
        ]);

        $articleSentiment = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        return SentimentDTO::from($articleSentiment["data"]);

    }
}
