<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

# Расширенные правила для Laravel-валидатора

[![Version][badge_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![StyleCI][badge_styleci]][link_styleci]
[![Coverage][badge_coverage]][link_coverage]
[![Quality][badge_quality]][link_coverage]
[![Issues][badge_issues]][link_issues]
[![License][badge_license]][link_license]
[![Downloads][badge_downloads]][link_packagist]

Данный пакет расширяет "стандартные" правила встроенного в **Laravel >=5.5** [валидатора][laravel_validation].

## Установка

Для установки данного пакета выполните в терминале следующую команду:

```shell
$ composer require avto-dev/extended-laravel-validator "^1.0.5"
```

> Для этого необходим установленный `composer`. Для его установки перейдите по [данной ссылке][getcomposer].

> Обратите внимание на то, что необходимо фиксировать мажорную версию устанавливаемого пакета.

Если вы используете Laravel версии 5.5 и выше, то сервис-провайдер данного пакета будет зарегистрирован автоматически. В противном случае вам необходимо самостоятельно зарегистрировать сервис-провайдер в секции `providers` файла `./config/app.php`:

```php
'providers' => [
    // ...
    AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider::class,
]
```

## Использование

Данный пакет позволяет использовать следующие правила [валидатора][laravel_validation]:

Правило    | Описание
---------- | ---
`vin_code` | VIN-код транспортного средства
`grz_code` | Государственный регистрационный знак (ГРЗ)
`sts_code` | Номер свидетельства о регистрации транспортного средства (СТС)
`pts_code` | Номер паспорта транспортного средства (ПТС)
`body_code` | Номер кузова транспортного средства
`chassis_code` | Номер шасси транспортного средства
`driver_license_code` | Номер водительского удостоверения

Пример использования:

```php
<?php

/** @var \Illuminate\Contracts\Validation\Factory $validator */
$validator = app()->make('validator');

$result = $validator->make([
    'value' => 'XWB3L32EDCA218918',
], [
    'value' => 'required|vin_code',
]);

$is_valid = $result->fails() === false;
```

## Тестирование

Для тестирования данного пакета используется фреймворк `phpunit`. Для запуска тестов выполните в терминале:

```shell
$ git clone git@github.com:avto-dev/extended-laravel-validator.git ./extended-laravel-validator && cd $_
$ composer update --dev
$ composer test
```

## Поддержка и развитие

Если у вас возникли какие-либо проблемы по работе с данным пакетом, пожалуйста, создайте соответствующий `issue` в данном репозитории.

Если вы способны самостоятельно реализовать тот функционал, что вам необходим - создайте PR с соответствующими изменениями. Крайне желательно сопровождать PR соответствующими тестами, фиксирующими работу ваших изменений. После проверки и принятия изменений будет опубликована новая минорная версия.

## Лицензирование

Код данного пакета распространяется под лицензией **MIT**.

[badge_version]:https://img.shields.io/packagist/v/avto-dev/extended-laravel-validator.svg?style=flat&maxAge=30
[badge_build_status]:https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/badges/build.png?b=master
[badge_styleci]:https://styleci.io/repos/108553281/shield?style=flat&maxAge=30
[badge_coverage]:https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/badges/coverage.png?b=master
[badge_license]:https://img.shields.io/packagist/l/avto-dev/extended-laravel-validator.svg?style=flat&maxAge=30
[badge_quality]:https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/badges/quality-score.png?b=master
[badge_issues]:https://img.shields.io/github/issues/avto-dev/extended-laravel-validator.svg?style=flat&maxAge=30
[badge_downloads]:https://img.shields.io/packagist/dt/avto-dev/extended-laravel-validator.svg?style=flat&maxAge=30
[link_packagist]:https://packagist.org/packages/avto-dev/extended-laravel-validator
[link_styleci]:https://styleci.io/repos/108553281
[link_build_status]:https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/build-status/master
[link_coverage]:https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/?branch=master
[link_license]:https://github.com/avto-dev/extended-laravel-validator/blob/master/LICENSE
[link_issues]:https://github.com/avto-dev/extended-laravel-validator/issues
[getcomposer]:https://getcomposer.org/download/
[laravel_validation]:https://laravel.com/docs/5.5/validation
