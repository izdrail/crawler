<?php

namespace UnixDevil\CrawlerBoat\Interfaces;

interface HtmlClientContract
{
    public function extract(): array;
}
