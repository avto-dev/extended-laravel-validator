
<p align="center">
  <img alt="laravel" src="https://habrastorage.org/webt/hr/6n/nm/hr6nnmgelolxqihsfb-qtp_ncci.png" width="70" height="70" />
</p>

# Расширенные правила для Laravel-валидатора

![Packagist](https://img.shields.io/packagist/v/avto-dev/extended-laravel-validator.svg?style=flat&maxAge=30)
[![Build Status](https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/badges/build.png?b=master)](https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/build-status/master)
![StyleCI](https://styleci.io/repos/108553281/shield?style=flat&maxAge=30)
[![Code Coverage](https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/?branch=master)
![GitHub issues](https://img.shields.io/github/issues/avto-dev/extended-laravel-validator.svg?style=flat&maxAge=30)

Данный пакет расширяет "стандартные" правила встроенного в **Laravel 5.x** [валидатора][laravel_validation].

## Установка

Для установки данного пакета выполните в терминале следующую команду:

```shell
$ composer require avto-dev/extended-laravel-validator "1.*"
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

Правило | Описание
--- | ---
`vin_code` | VIN-код транспортного средства
`grz_code` | Государственный регистрационный знак (ГРЗ)
`sts_code` | Номер свидетельства о регистрации транспортного средства (СТС)
`pts_code` | Номера паспорта транспортного средства (ПТС)

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
$ git clone git@github.com:avto-dev/extended-laravel-validator.git
$ cd ./extended-laravel-validator
$ composer update --dev
$ composer test
```

## Поддержка и развитие

Если у вас возникли какие-либо проблемы по работе с данным пакетом, пожалуйста, создайте соответствующий `issue` в данном репозитории.

Если вы способны самостоятельно реализовать тот функционал, что вам необходим - создайте PR с соответствующими изменениями. Крайне желательно сопровождать PR соответствующими тестами, фиксирующими работу ваших изменений. После проверки и принятия изменений будет опубликована новая минорная версия.

## Лицензирование

Код данного пакета распространяется под лицензией **MIT**.

[getcomposer]:https://getcomposer.org/download/
[laravel_validation]:https://laravel.com/docs/5.5/validation
