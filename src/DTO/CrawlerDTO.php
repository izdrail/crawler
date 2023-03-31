<?php
declare(strict_types=1);
namespace Cornatul\Crawler\DTO;

use Spatie\LaravelData\Data;

class CrawlerDTO extends Data
{

    public array $links = [];

    public string $iterator = "";

    public array $fields = [
        "url" => "",
        "title" => "",
        "content" => "",
        "category" => "",
        "image" => "",
    ];
}
