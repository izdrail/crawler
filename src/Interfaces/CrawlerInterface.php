<?php

namespace Cornatul\CrawlerBoat\Interfaces;

use Cornatul\CrawlerBoat\DTO\HtmlDTO;

/**
 * Interface HtmlClientContract
 */
interface CrawlerInterface
{
    /**
     * Provides a way to extract data
     * @method extract
     * @param HtmlDTO $dto
     * @return array
     */
    public function extract(HtmlDTO $dto): array;
}
