<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Interfaces;

use Cornatul\Crawler\Dto\HtmlDTO;
use Illuminate\Support\Collection;

/**
 * Interface HtmlClientContract
 */
interface CrawlerInterface
{
    /**
     * Provides a way to extract data and will dispatch a job to process the data.
     * @method extract
     * @param HtmlDto $dto
     */
    public function extract(HtmlDTO $dto): Collection;
}
