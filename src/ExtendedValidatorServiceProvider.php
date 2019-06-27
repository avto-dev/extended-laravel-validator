<?php

namespace AvtoDev\ExtendedLaravelValidator;

use Illuminate\Contracts\Validation\Factory as Validator;
use Illuminate\Support\ServiceProvider as IlluminateServiceProvider;

class ExtendedValidatorServiceProvider extends IlluminateServiceProvider
{
    /**
     * Стек инстансов расширений валидатора.
     *
     * @var ValidationExtensionInterface[]
     */
    protected $extensions = [];

    /**
     * Get config root key name.
     *
     * @return string
     */
    public static function getConfigRootKeyName()
    {
        return \basename(static::getConfigPath(), '.php');
    }

    /**
     * Returns path to the configuration file.
     *
     * @return string
     */
    public static function getConfigPath()
    {
        return __DIR__ . '/config/extended-laravel-validator.php';
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootExtensions();

        $this->registerExtensions();
    }

    /**
     * Register package services.
     *
     * @return void
     */
    public function register()
    {
        $this->initializeConfigs();
    }

    /**
     * Возвращает массив имен классов расширений валидатора, подлежащих загрузке.
     *
     * @return string[]
     */
    public function getExtensionsClassesNames()
    {
        return array_replace([
            Extensions\VinCodeValidatorExtension::class,
            Extensions\GrzCodeValidatorExtension::class,
            Extensions\StsCodeValidatorExtension::class,
            Extensions\PtsCodeValidatorExtension::class,
            Extensions\BodyCodeValidatorExtension::class,
            Extensions\ChassisCodeValidatorExtension::class,
            Extensions\DriverLicenseNumberValidatorExtension::class,
            Extensions\CadastralNumberValidatorExtension::class,
        ], $this->getConfigExtensionsClassesNames());
    }

    /**
     * Get an extensions classes names, declared in configuration file.
     *
     * @return string[]|array
     */
    public function getConfigExtensionsClassesNames()
    {
        return (array) $this->app->make('config')->get(
            sprintf('%s.extensions', static::getConfigRootKeyName())
        );
    }

    /**
     * Initialize configs.
     *
     * @return void
     */
    protected function initializeConfigs()
    {
        $this->mergeConfigFrom(static::getConfigPath(), static::getConfigRootKeyName());

        $this->publishes([
            \realpath(static::getConfigPath()) => config_path(\basename(static::getConfigPath())),
        ], 'config');
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

    /**
     * Производит создание инстансов объектов-расширений валидатора.
     *
     * @see getExtensionsClassesNames
     *
     * @return void
     */
    protected function bootExtensions()
    {
        foreach ((array) $this->getExtensionsClassesNames() as $class_name) {
            $this->extensions[] = new $class_name;
        }
    }

    /**
     * Расширяет инстанс валидатора расширениями, что были инициализированы.
     *
     * @see bootExtensions
     *
     * @return void
     */
    protected function registerExtensions()
    {
        $validator = $this->getValidator();

        foreach ($this->extensions as &$extension) {
            $validator->extend($extension->name(), function ($attribute, $value) use (&$extension) {
                return (bool) $extension->passes($attribute, $value);
            }, $extension->message());
        }
    }
}
