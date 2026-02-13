<?php

declare(strict_types = 1);

namespace AvtoDev\ExtendedLaravelValidator;

use Illuminate\Contracts\Container\Container;
use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Contracts\Config\Repository as ConfigRepository;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Get config root key name.
     *
     * @return string
     */
    public static function getConfigRootKeyName(): string
    {
        return \basename(static::getConfigPath(), '.php');
    }

    /**
     * Returns path to the configuration file.
     *
     * @return string
     */
    public static function getConfigPath(): string
    {
        return __DIR__ . '/../config/extended-laravel-validator.php';
    }

    /**
     * Register package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->initializeConfigs();
    }

    /**
     * Bootstrap any application services.
     *
     * @param Container $container
     * @param Validator $factory
     *
     * @return void
     */
    public function boot(Container $container, Validator $factory): void
    {
        foreach ($this->getExtensionsClassesNames() as $class_name) {
            /** @var ValidationExtensionInterface $extension */
            $extension = $container->make($class_name);

            $factory->extend($extension->name(), static function ($attribute, $value) use ($extension): bool {
                return $extension->passes($attribute, $value);
            }, $extension->message());
        }
    }

    /**
     * Get extensions class names.
     *
     * @return string[]
     */
    public function getExtensionsClassesNames(): array
    {
        return \array_unique(\array_merge([
            Extensions\VinCodeValidatorExtension::class,
            Extensions\GrzCodeValidatorExtension::class,
            Extensions\StsCodeValidatorExtension::class,
            Extensions\PtsCodeValidatorExtension::class,
            Extensions\BodyCodeValidatorExtension::class,
            Extensions\ChassisCodeValidatorExtension::class,
            Extensions\DriverLicenseNumberValidatorExtension::class,
            Extensions\CadastralNumberValidatorExtension::class,
            Extensions\EptsCodeValidatorExtension::class,
        ], $this->getConfigExtensionsClassesNames()));
    }

    /**
     * Get an extensions classes names, declared in configuration file.
     *
     * @return class-string[]|array
     */
    public function getConfigExtensionsClassesNames(): array
    {
        /** @var ConfigRepository $config */
        $config = $this->app->make(ConfigRepository::class);

        /** @var class-string[] $extensions */
        $extensions = $config->get(static::getConfigRootKeyName() . '.extensions', []);

        return $extensions;
    }

    /**
     * Initialize configs.
     *
     * @return void
     */
    protected function initializeConfigs(): void
    {
        $this->mergeConfigFrom(static::getConfigPath(), static::getConfigRootKeyName());

        $this->publishes([
            \realpath(static::getConfigPath()) => config_path(\basename(static::getConfigPath())),
        ], 'config');
    }
}
