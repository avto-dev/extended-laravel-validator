<p align="center">
  <img src="https://laravel.com/assets/img/components/logo-laravel.svg" alt="Laravel" width="240" />
</p>

# Extensions for Laravel Validator

[![Version][badge_packagist_version]][link_packagist]
[![PHP Version][badge_php_version]][link_packagist]
[![Build Status][badge_build_status]][link_build_status]
[![Coverage][badge_coverage]][link_coverage]
[![Downloads count][badge_downloads_count]][link_packagist]
[![License][badge_license]][link_license]

This package provides extended validation rules for [Laravel validator][laravel_validation].

## Install

Require this package with composer using the following command:

```shell
$ composer require avto-dev/extended-laravel-validator "^3.0"
```

> Installed `composer` is required ([how to install composer][getcomposer]).

> You need to fix the major version of package.

After that you can "publish" configuration file (`./config/extended-laravel-validator.php`) using next command:

```bash
$ ./artisan vendor:publish --provider="AvtoDev\\ExtendedLaravelValidator\\ServiceProvider"
```

## Usage

This package provides next validation rules:

Rule       | Description
---------- | -----------
`vin_code` | Vehicle VIN-code
`grz_code` | Vehicle GRZ-code
`sts_code` | Vehicle Registration Certificate Number (STS)
`pts_code` | Vehicle Passport Number (PTS)
`body_code` | Vehicle body number
`chassis_code` | Vehicle chassis number
`driver_license_number` | Driving license number
`cadastral_number` | Cadastral number (unique property number)

Usage example:

```php
<?php

/** @var \Illuminate\Contracts\Validation\Factory $validator */
$validator = resolve('validator');

$result = $validator->make([
    'value' => 'XWB3L32EDCA218918',
], [
    'value' => 'required|vin_code',
]);

$is_valid = $result->fails() === false;
```

### Testing

For package testing we use `phpunit` framework and `docker-ce` + `docker-compose` as develop environment. So, just write into your terminal after repository cloning:

```bash
$ make build
$ make latest # or 'make lowest'
$ make test
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
[badge_build_status]:https://img.shields.io/github/workflow/status/avto-dev/extended-laravel-validator/tests/master
[badge_coverage]:https://img.shields.io/codecov/c/github/avto-dev/extended-laravel-validator/master.svg?maxAge=60
[badge_downloads_count]:https://img.shields.io/packagist/dt/avto-dev/extended-laravel-validator.svg?maxAge=180
[badge_license]:https://img.shields.io/packagist/l/avto-dev/extended-laravel-validator.svg?longCache=true
[badge_release_date]:https://img.shields.io/github/release-date/avto-dev/extended-laravel-validator.svg?style=flat-square&maxAge=180
[badge_commits_since_release]:https://img.shields.io/github/commits-since/avto-dev/extended-laravel-validator/latest.svg?style=flat-square&maxAge=180
[badge_issues]:https://img.shields.io/github/issues/avto-dev/extended-laravel-validator.svg?style=flat-square&maxAge=180
[badge_pulls]:https://img.shields.io/github/issues-pr/avto-dev/extended-laravel-validator.svg?style=flat-square&maxAge=180
[link_releases]:https://github.com/avto-dev/extended-laravel-validator/releases
[link_packagist]:https://packagist.org/packages/avto-dev/extended-laravel-validator
[link_build_status]:https://github.com/avto-dev/extended-laravel-validator/actions
[link_coverage]:https://codecov.io/gh/avto-dev/extended-laravel-validator/
[link_changes_log]:https://github.com/avto-dev/extended-laravel-validator/blob/master/CHANGELOG.md
[link_issues]:https://github.com/avto-dev/extended-laravel-validator/issues
[link_create_issue]:https://github.com/avto-dev/extended-laravel-validator/issues/new/choose
[link_commits]:https://github.com/avto-dev/extended-laravel-validator/commits
[link_pulls]:https://github.com/avto-dev/extended-laravel-validator/pulls
[link_license]:https://github.com/avto-dev/extended-laravel-validator/blob/master/LICENSE
[getcomposer]:https://getcomposer.org/download/
[laravel_validation]:https://laravel.com/docs/5.8/validation
