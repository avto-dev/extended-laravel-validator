<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

# Расширенные правила для Laravel-валидатора

[![Version][badge_packagist_version]][link_packagist]
[![Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Code quality][badge_code_quality]][link_code_quality]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

Данный пакет расширяет "стандартные" правила встроенного в Laravel [валидатора][laravel_validation].

## Install

Require this package with composer using the following command:

```shell
$ composer require avto-dev/extended-laravel-validator "^2.1"
```

Если вы используете Laravel версии 5.5 и выше, то сервис-провайдер данного пакета будет зарегистрирован автоматически. В противном случае вам необходимо самостоятельно зарегистрировать сервис-провайдер в секции `providers` файла `./config/app.php`:

```php
'providers' => [
    // ...
    AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider::class,
]
```

После этого вы можете опубликовать конфигурационный файл пакета с помощью следующей команды:

```shell
$ ./artisan vendor:publish --provider="AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider"
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
`driver_license_number` | Номер водительского удостоверения
`cadastral_number` | Кадастровый номер (уникальный номер объекта недвижимости)

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

> Опционально вы можете в конфигурационном файле указать дополнительные расширения валидатора, которые вам необходимы.

### Testing

For package testing we use `phpunit` framework. Just write into your terminal:

```shell
$ git clone git@github.com:avto-dev/extended-laravel-validator.git ./extended-laravel-validator && cd $_
$ composer update --dev
$ composer test
```

## Changes log

[![Release date][badge_release_date]][link_releases]
[![Commits since latest release][badge_commits_since_release]][link_commits]

Changes log can be [found here][link_changes_log].

## Support

[![Issues][badge_issues]][link_issues]
[![Issues][badge_pulls]][link_pulls]

If you will find any package errors, please, [make an issue][link_create_issue] in current repository.

## License

This is open-sourced software licensed under the [MIT License][link_license].

[badge_packagist_version]:https://img.shields.io/packagist/v/avto-dev/extended-laravel-validator.svg?maxAge=180
[badge_php_version]:https://img.shields.io/packagist/php-v/avto-dev/extended-laravel-validator.svg?longCache=true
[badge_build_status]:https://travis-ci.org/avto-dev/extended-laravel-validator.svg?branch=master
[badge_code_quality]:https://img.shields.io/scrutinizer/g/avto-dev/extended-laravel-validator.svg?maxAge=180
[badge_coverage]:https://img.shields.io/codecov/c/github/avto-dev/extended-laravel-validator/master.svg?maxAge=60
[badge_downloads_count]:https://img.shields.io/packagist/dt/avto-dev/extended-laravel-validator.svg?maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avto-dev/extended-laravel-validator.svg?longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avto-dev/extended-laravel-validator.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avto-dev/extended-laravel-validator/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avto-dev/extended-laravel-validator.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avto-dev/extended-laravel-validator.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avto-dev/extended-laravel-validator/releases
[link_packagist]:https://packagist.org/packages/avto-dev/extended-laravel-validator
[link_build_status]:https://travis-ci.org/avto-dev/extended-laravel-validator
[link_coverage]:https://codecov.io/gh/avto-dev/extended-laravel-validator/
[link_changes_log]:https://github.com/avto-dev/extended-laravel-validator/blob/master/CHANGELOG.md
[link_code_quality]:https://scrutinizer-ci.com/g/avto-dev/extended-laravel-validator/
[link_issues]:https://github.com/avto-dev/extended-laravel-validator/issues
[link_create_issue]:https://github.com/avto-dev/extended-laravel-validator/issues/new/choose
[link_commits]:https://github.com/avto-dev/extended-laravel-validator/commits
[link_pulls]:https://github.com/avto-dev/extended-laravel-validator/pulls
[link_license]:https://github.com/avto-dev/extended-laravel-validator/blob/master/LICENSE
[getcomposer]:https://getcomposer.org/download/
[laravel_validation]:https://laravel.com/docs/5.5/validation
