<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests;

use ReflectionClass;
use AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider;

/**
 * Class ServiceProviderTest.
 *
 * Тесты сервис-провайдера.
 */
class ServiceProviderTest extends AbstractUnitTestCase
{
    /**
     * Тест констант сервис-провайдера.
     *
     * @return void
     */
    public function testConstants()
    {
        $this->assertEquals(
            'extended-laravel-validator.registered',
            ExtendedValidatorServiceProvider::SERVICE_PROVIDER_REGISTERED_ABSTRACT
        );
    }

    /**
     * Тест того, что сервис провайдер был зарегистрирован.
     *
     * @return void
     */
    public function testServiceProviderRegistered()
    {
        $this->assertTrue($this->app->make(ExtendedValidatorServiceProvider::SERVICE_PROVIDER_REGISTERED_ABSTRACT));
    }

    /**
     * Тест того, что необходимые правила валидатора были зарегистрированы.
     *
     * @return void
     */
    public function testRegisteredValidatorRules()
    {
        /** @var \Illuminate\Validation\Factory $laravel_validator */
        $laravel_validator = $this->app->make('validator');

        $reflection          = new ReflectionClass(clone $laravel_validator);
        $reflection_property = $reflection->getProperty('extensions');
        $reflection_property->setAccessible(true);

        $loaded_extensions = array_keys($reflection_property->getValue($laravel_validator));

        foreach (['vin_code', 'grz_code', 'sts_code', 'pts_code', 'body_code', 'chassis_code'] as $extension_name) {
            $this->assertContains($extension_name, $loaded_extensions);
        }
    }
}
