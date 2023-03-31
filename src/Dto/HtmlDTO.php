<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Dto;

use Spatie\LaravelData\Data;

class HtmlDTO extends Data
{
    public string $base_url;

    public array $links = [];

    public string $iterator = "";

    //todo change this to an empty array that will accept any key
    public array $fields = [
        "url" => "",
        "title" => "",
        "content" => "",
        "category" => "",
        "image" => "",
    ];
}
