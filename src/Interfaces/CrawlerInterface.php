<?php

namespace Cornatul\Crawler\Interfaces;

use Cornatul\Crawler\Dto\HtmlDto;

/**
 * Interface HtmlClientContract
 */
interface CrawlerInterface
{
    /**
     * Provides a way to extract data
     * @method extract
     * @param HtmlDto $dto
     * @return array
     */
    public function extract(HtmlDto $dto): array;
}
