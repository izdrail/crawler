<?php

namespace Cornatul\CrawlerBoat\DTO;

use Spatie\LaravelData\Data;

class HtmlDTO extends Data
{
    public string $base_url;

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
