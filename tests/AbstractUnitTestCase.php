<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests;

use Illuminate\Foundation\Application;
use Illuminate\Contracts\Console\Kernel;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider;

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
        $app->register(ExtendedValidatorServiceProvider::class);

        return $app;
    }

    /**
     * Возвращает инстанс валидатора.
     *
     * @return Validator
     */
    protected function getValidator()
    {
        return $this->app->make('validator');
    }
}
