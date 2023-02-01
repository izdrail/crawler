<?php

namespace UnixDevil\CrawlerBoat\Tests;


use UnixDevil\CrawlerBoat\CrawlerBoatProvider;
use UnixDevil\NewsBoat\NewsBoatServiceProvider;
use PHPUnit\Framework\TestCase as BaseTestCase;
class TestCase extends BaseTestCase
{
    public function setUp(): void
    {
        parent::setUp();
        // additional setup
    }

    final protected function getPackageProviders($app)
    {
        return [
            CrawlerBoatProvider::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // perform environment setup
    }
}
