<?php

namespace Cornatul\CrawlerBoat\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Cornatul\CrawlerBoat\DTO\HtmlDTO;
use Cornatul\CrawlerBoat\Interfaces\HtmlClientContract;

class CrawlerClient implements HtmlClientContract
{
    private ClientInterface $client;

    private ConsoleOutputInterface $output;

    public const HEADERS = [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        'Accept' => 'text/html,application/xhtml',
        'Accept-Language' => 'en-US,en;q=0.9',
        'Accept-Encoding' => 'gzip, deflate, br',
        'Connection' => 'keep-alive',
        'Upgrade-Insecure-Requests' => '1',
        'Cache-Control' => 'max-age=0',
        'TE' => 'Trailers',
    ];

    public function __construct(ClientInterface $client, ConsoleOutputInterface $output)
    {
        $this->client = $client;
        $this->output = $output;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function extract(HTMLDTO $dto): array
    {
        $results = [];

        $links = $dto->links;

        foreach ($links as $category => $link) {

            $this->output->write($link);

            $content = $this->client->request('GET', $link, [
                'headers' => self::HEADERS,
            ]);

            if ($content->getStatusCode() ===200) {
                $body = $content->getBody()->getContents();
                $results[] = $this->processBody($dto, $body, $category);
            }
            if ($content->getStatusCode() === 403) {
                throw new \Exception("403 Forbidden");
            }

            if ($content->getStatusCode() === 404) {
                throw new \Exception("404 Not Found");
            }

            if ($content->getStatusCode() === 500) {
                throw new \Exception("500 Internal Server Error");
            }
        }
        return $results;
    }


    private function processBody(HtmlDTO $dto, string $body, string $category): array
    {
        $results = [];
        $crawler = new Crawler($body);
        $crawler->filter($dto->iterator)->each(/**
         */ function (Crawler $node, $i) use ($category, $results, $dto) {
            $dto->fields["category"] = $category;
            if (str_contains($node->attr('href'), $dto->base_url)) {
                $results[] = $this->processSingle($node->attr('href'), $dto);
            }
            $results[] = $this->processSingle($dto->base_url . $node->attr('href'), $dto);
        });
        return $results;
    }

    private function processSingle(string $url, HtmlDTO $dto): array
    {
        $results = [];
        $this->output->write($url);
        $content = $this->client->request('GET', $url, [
            'headers' => self::HEADERS,
        ]);

        if ($content->getStatusCode() === 200) {
            $body = $content->getBody()->getContents();
            $crawler = new Crawler($body);

            foreach ($dto->fields as $key => $value) {

                $this->output->write($key);

                if($key ==="url"){
                    continue;
                }

                if($key ==="category"){
                    continue;
                }

                if($key !== ""){
                    $results[$key] = $crawler->filter($value)->text();
                }
            }
            $this->output->write($results);
            return $results;
        }
        if ($content->getStatusCode() === 403) {
            throw new \Exception("403 Forbidden");
        }

        if ($content->getStatusCode() === 404) {
            throw new \Exception("404 Not Found");
        }

        if ($content->getStatusCode() === 500) {
            throw new \Exception("500 Internal Server Error");
        }
        return $results;
    }
}
