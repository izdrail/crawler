<?php

namespace Cornatul\CrawlerBoat\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;
use Symfony\Component\Console\Output\OutputInterface;
use Cornatul\CrawlerBoat\DTO\SentimentDTO;
use Cornatul\CrawlerBoat\Facades\CrawlerConfig;
use Cornatul\CrawlerBoat\Interfaces\SentimentInterface;


/**
 * @class SentimentClient
 */
class SentimentClient implements SentimentInterface
{

    private ClientInterface $client;

    private ConsoleOutputInterface $output;

    public function __construct(ClientInterface $client, ConsoleOutputInterface $output)
    {
        $this->client = $client;
        $this->output = $output;

    }


    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function getSentiment(string $urlToExtract): SentimentDTO
    {
        //
        $response = $this->client->post(CrawlerConfig::getSentimentEndpoint(), [
            'json' => [
                'link' => $urlToExtract
            ]
        ]);

        $articleSentiment = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $this->output->writeln(json_encode($articleSentiment['sentiment'], JSON_THROW_ON_ERROR));

        return SentimentDTO::from($articleSentiment["data"]);

    }
}
