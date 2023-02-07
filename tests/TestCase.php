<?php

namespace Cornatul\CrawlerBoat\Tests;


use Cornatul\Crawler\CrawlerProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

    }

    final protected function getPackageProviders($app):array
    {
        $app->register(CrawlerProvider::class);
        return [
            CrawlerProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // perform environment setup
    }
}
