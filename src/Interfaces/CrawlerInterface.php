<?php
declare(strict_types=1);
namespace Cornatul\Crawler\Interfaces;

use Cornatul\Crawler\DTO\CrawlerDTO;
use Illuminate\Support\Collection;
use Spatie\LaravelData\Data;

/**
 * Interface HtmlClientContract
 */
interface CrawlerInterface
{
    /**
     * Provides a way to extract data and will dispatch a job to process the data.
     * @method extract
     */
    public function extract(CrawlerDTO $dto): Collection;
}
