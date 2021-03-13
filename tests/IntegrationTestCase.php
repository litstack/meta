<?php

namespace Tests;

use CreateMetaTable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Litstack\Meta\MetaServiceProvider;
use Litstack\Rehearsal\TestCase as LitstackTestCase;

class IntegrationTestCase extends LitstackTestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        include_once __DIR__.'/../database/migrations/create_meta_table.php.stub';
        (new CreateMetaTable())->up();
    }

    protected function getPackageProviders($app)
    {
        return [
            MetaServiceProvider::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
