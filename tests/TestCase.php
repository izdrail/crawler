<?php

namespace Cornatul\Crawler\Tests;


use Cornatul\Crawler\CrawlerServiceProvider;

class TestCase extends \Orchestra\Testbench\TestCase
{
    public function setUp(): void
    {
        parent::setUp();

    }

    final protected function getPackageProviders($app):array
    {
        $app->register(CrawlerServiceProvider::class);
        return [
            CrawlerServiceProvider::class
        ];
    }

    protected function getEnvironmentSetUp($app): void
    {
        // perform environment setup
    }
}
