<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Client;

use Cornatul\Crawler\Dto\SentimentDto;
use Cornatul\Crawler\Helpers\CrawlerConfig;
use Cornatul\Crawler\Interfaces\SentimentInterface;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use JsonException;


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
    public function getSentiment(string $urlToExtract): SentimentDto
    {
        //
        $response = $this->client->post(CrawlerConfig::getSentimentEndpoint(), [
            'json' => [
                'link' => $urlToExtract
            ]
        ]);

        $articleSentiment = json_decode($response->getBody()->getContents(), true, 512, JSON_THROW_ON_ERROR);

        $this->output->writeln(json_encode($articleSentiment['sentiment'], JSON_THROW_ON_ERROR));

        return SentimentDto::from($articleSentiment["data"]);

    }
}
