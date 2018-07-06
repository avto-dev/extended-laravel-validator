<?php

namespace AvtoDev\ExtendedLaravelValidator\Tests;

use Mockery as m;
use ReflectionClass;
use AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider;
use AvtoDev\ExtendedLaravelValidator\Tests\Extensions\Stubs\ExtensionStub;

class ServiceProviderTest extends AbstractUnitTestCase
{
    /**
     * Тест того, что сервис провайдер был зарегистрирован.
     *
     * @return void
     */
    public function testServiceProviderRegistered()
    {
        $loaded_providers = $this->app->getLoadedProviders();

        $this->assertContains(ExtendedValidatorServiceProvider::class, \array_keys($loaded_providers));
    }

    /**
     * Тест того, что необходимые правила валидатора были зарегистрированы.
     *
     * @throws \ReflectionException
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

        $extensions_names = [
            'vin_code',
            'grz_code',
            'sts_code',
            'pts_code',
            'body_code',
            'chassis_code',
            'driver_license_number',
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
    public function testServiceProviderMethods()
    {
        $this->assertEquals('extended-laravel-validator', ExtendedValidatorServiceProvider::getConfigRootKeyName());

        $this->assertEquals(
            \realpath(__DIR__ . '/../src/config/extended-laravel-validator.php'),
            ExtendedValidatorServiceProvider::getConfigPath()
        );
    }

    /**
     * Test package configs.
     *
     * @return void
     */
    public function testPackageConfig()
    {
        $original_config_content = require __DIR__ . '/../src/config/extended-laravel-validator.php';

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
    public function testGettingExtensionsFromConfigurationFile()
    {
        $mock = m::mock(
            sprintf('%s[%s]', ExtendedValidatorServiceProvider::class, $what = 'getConfigExtensionsClassesNames'),
            [$this->app]
        );

        $mock->shouldReceive($what)->once()->andReturn([ExtensionStub::class]);

        /* @var ExtendedValidatorServiceProvider $mock */
        $this->assertContains(ExtensionStub::class, $mock->getExtensionsClassesNames());
    }
}
