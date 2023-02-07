<?php

namespace Cornatul\CrawlerBoat\Tests;


use Cornatul\CrawlerBoat\Providers\CrawlerBoatProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

    }

    final protected function getPackageProviders($app):array
    {
        $app->register(CrawlerBoatProvider::class);
        return [
            CrawlerBoatProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // perform environment setup
    }
}
