<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Client;

use Cornatul\Crawler\Interfaces\CrawlerInterface;
use Exception;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Collection;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DomCrawler\Crawler;
use Cornatul\Crawler\Dto\CrawlerDTO;


class CrawlerClient implements CrawlerInterface
{
    private ClientInterface $client;

    private ConsoleOutputInterface $output;

    private array $keyDenied = [
        "url",
        "category",
    ];

    public array $headers = [
        'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)',
        'Accept' => 'text/html,application/xhtml',
        'Accept-Language' => 'en-US,en;q=0.9',
        'Accept-Encoding' => 'gzip, deflate, br',
        'Connection' => 'keep-alive',
        'Upgrade-Insecure-Requests' => '1',
        'Cache-Control' => 'max-age=0',
    ];

    public function __construct(ClientInterface $client, ConsoleOutputInterface $output)
    {
        $this->client = $client;
        $this->output = $output;
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function extract(CrawlerDTO $dto): Collection
    {
        $results = collect();

        $links = $dto->links;

        foreach ($links as $category => $link) {

            $this->output->write($link);

            $content = $this->client->request('GET', $link, [
                'headers' => $this->headers,
            ]);

            if ($content->getStatusCode() ===200) {
                $body = $content->getBody()->getContents();
                $response = $this->processBody($dto, $body, $category);
                $results->push($response);
            }
            if ($content->getStatusCode() === 403) {
                throw new \RuntimeException("403 Forbidden");
            }

            if ($content->getStatusCode() === 404) {
                throw new \RuntimeException("404 Not Found");
            }

            if ($content->getStatusCode() === 500) {
                throw new \RuntimeException("500 Internal Server Error");
            }
        }
        return $results;
    }


    /**
     * @param HtmlDto $dto
     * @param string $body
     * @param string $category
     * @return Collection
     * @throws GuzzleException
     * @todo replace the return with a collection from laravel
     */
    private function processBody(CrawlerDTO $dto, string $body, string $category): Collection
    {
        $results = collect();
        $crawler = new Crawler($body);

        try {
            $crawler->filter($dto->iterator)->each( function (Crawler $node, $i) use ($category, $results, $dto) {
                $dto->fields["category"] = $category;
                if (str_contains($node->attr('href'), $dto->base_url))
                {
                    $results->push(
                        $this->processSingle($node->attr('href'), $dto)
                    );
                }
                $results->push(
                    $this->processSingle($dto->base_url . $node->attr('href'), $dto)
                );
            });
        }catch (Exception $e){
            $this->output->write($e->getMessage());
        }
        return $results;
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     * @todo replace the return with a collection from laravel
     */
    private function processSingle(string $url, CrawlerDTO $dto): array
    {
        $results = [];

        $this->output->write($url);

        $content = $this->client->request('GET', $url, [
            'headers' => $this->headers,
        ]);

        if ($content->getStatusCode() === 200) {

            $body = $content->getBody()->getContents();

            $crawler = new Crawler($body);

            foreach ($dto->fields as $key => $value)
            {
                $this->output->write($key);
                //todo insert a test for this & merge this with the other part of the code
                if(in_array($key, $this->keyDenied, true)){
                    continue;
                }

                if($key !== "")
                {
                    $results[$key] = $crawler->filter($value)->text();
                }
            }

            $this->output->write($results);

            return $results;

        }
        if ($content->getStatusCode() === 403) {
            throw new \RuntimeException("403 Forbidden");
        }

        if ($content->getStatusCode() === 404) {
            throw new \RuntimeException("404 Not Found");
        }

        if ($content->getStatusCode() === 500) {
            throw new \RuntimeException("500 Internal Server Error");
        }
        return $results;
    }
}
