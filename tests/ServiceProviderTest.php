<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator\Tests;

use Mockery as m;
use ReflectionClass;
use AvtoDev\ExtendedLaravelValidator\ServiceProvider;
use AvtoDev\ExtendedLaravelValidator\Tests\Extensions\Stubs\ExtensionStub;

/**
 * @covers \AvtoDev\ExtendedLaravelValidator\ServiceProvider
 */
class ServiceProviderTest extends AbstractUnitTestCase
{
    /**
     * Тест того, что сервис провайдер был зарегистрирован.
     *
     * @return void
     */
    public function testServiceProviderRegistered(): void
    {
        $loaded_providers = $this->app->getLoadedProviders();

        $this->assertContains(ServiceProvider::class, \array_keys($loaded_providers));
    }

    /**
     * Тест того, что необходимые правила валидатора были зарегистрированы.
     *
     * @throws \ReflectionException
     *
     * @return void
     */
    public function testRegisteredValidatorRules(): void
    {
        /** @var \Illuminate\Validation\Factory $laravel_validator */
        $laravel_validator = $this->app->make('validator');

        $reflection          = new ReflectionClass(clone $laravel_validator);
        $reflection_property = $reflection->getProperty('extensions');
        $reflection_property->setAccessible(true);

        $loaded_extensions = \array_keys($reflection_property->getValue($laravel_validator));

        $extensions_names = [
            'vin_code',
            'grz_code',
            'sts_code',
            'pts_code',
            'body_code',
            'chassis_code',
            'driver_license_number',
            'cadastral_number',
        ];

        foreach ($extensions_names as $extension_name) {
            $this->assertContains($extension_name, $loaded_extensions);
        }
    }

    /**
     * Test service provider public methods.
     *
     * @return void
     */
    public function testServiceProviderMethods(): void
    {
        $this->assertSame('extended-laravel-validator', ServiceProvider::getConfigRootKeyName());

        $this->assertSame(
            \realpath(__DIR__ . '/../config/extended-laravel-validator.php'),
            \realpath(ServiceProvider::getConfigPath())
        );
    }

    /**
     * Test package configs.
     *
     * @return void
     */
    public function testPackageConfig(): void
    {
        $original_config_content = require __DIR__ . '/../config/extended-laravel-validator.php';

        $this->assertInternalType('array', $original_config_content);
        $this->assertArrayHasKey('extensions', $original_config_content);
        $this->assertEmpty($original_config_content['extensions']);

        $this->assertEquals($this->app->make('config')->get('extended-laravel-validator'), $original_config_content);
    }

    /**
     * Test getting extensions from configuration file.
     *
     * @return void
     */
    public function testGettingExtensionsFromConfigurationFile(): void
    {
        $mock = m::mock(
            sprintf('%s[%s]', ServiceProvider::class, $what = 'getConfigExtensionsClassesNames'),
            [$this->app]
        );

        $mock->shouldReceive($what)->once()->andReturn([ExtensionStub::class])->getMock();

        /* @var ServiceProvider $mock */
        $this->assertContains(ExtensionStub::class, $mock->getExtensionsClassesNames());
    }
}
