<?php

namespace UnixDevil\CrawlerBoat\Client;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Symfony\Component\DomCrawler\Crawler;
use UnixDevil\CrawlerBoat\DTO\HtmlDTO;
use UnixDevil\CrawlerBoat\Interfaces\HtmlClientContract;

class HtmlClient implements HtmlClientContract
{
    private ClientInterface $client;
    private HtmlDTO $dto;

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

    public function __construct(ClientInterface $client, HTMLDTO $htmlDTO)
    {
        $this->client = $client;
        $this->dto = $htmlDTO;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function extract(): array
    {
        $results = [];
        $links = $this->dto->links;

        foreach ($links as $category => $link) {
            $content = $this->client->request('GET', $link, [
                'headers' => self::HEADERS,
            ]);
            if ($content->getStatusCode() ===200) {
                $body = $content->getBody()->getContents();
                $results[] = $this->processBody($body, $category);
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


    private function processBody(string $body, string $category): array
    {
        $results = [];
        $crawler = new Crawler($body);
        $crawler->filter($this->dto->iterator)->each(/**
         * @throws Exception
         */ function (Crawler $node, $i) use ($category, $results) {
            $this->dto->fields["category"] = $category;
            if (str_contains($node->attr('href'), $this->dto->base_url)) {
                $results[] = $this->processSingle($node->attr('href'), $this->dto);
            }
            $results[] = $this->processSingle($this->dto->base_url . $node->attr('href'), $this->dto);
        });
        return $results;
    }

    private function processSingle(string $url, HtmlDTO $dto): HtmlDTO
    {
        $dto->fields["url"] = trim(str_replace(PHP_EOL, '', $url));
        $content = $this->client->get($this->dto->fields["url"]);
        $body = $content->getBody()->getContents();
        $crawler = new Crawler($body);
        foreach ($this->dto->fields as $field => $value) {
            if ($field === "url") {
                continue;
            }
            if ($field === "category") {
                continue;
            }
            $crawler->filter($this->dto->fields[$field])->each(function (Crawler $node, $i) use ($field) {
                $this->dto->fields[$field] = $node->text();
            });
        }
        return $this->dto;
    }
}
