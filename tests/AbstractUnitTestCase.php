<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use AvtoDev\ExtendedLaravelValidator\ServiceProvider;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class AbstractUnitTestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../vendor/laravel/laravel/bootstrap/app.php';

        $app->make(Kernel::class)->bootstrap();

        // Register our service-provider manually
        $app->register(ServiceProvider::class);

        return $app;
    }

    /**
     * @return Validator
     */
    protected function getValidator(): Validator
    {
        return $this->app->make('validator');
    }
}
