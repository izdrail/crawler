<?php

namespace UnixDevil\CrawlerBoat\Interfaces;

use UnixDevil\CrawlerBoat\DTO\HtmlDTO;

/**
 * Interface HtmlClientContract
 */
interface HtmlClientContract
{
    /**
     * Provides a way to extract data
     * @method extract
     * @param HtmlDTO $dto
     * @return array
     */
    public function extract(HtmlDTO $dto): array;
}
