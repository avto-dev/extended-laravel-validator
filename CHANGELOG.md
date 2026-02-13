# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

## Unreleased

### Added

- `epts_code` validator

### Changed

- Rules of `vin_code`, `body_code`, `chassis_code`, `grz_code`, `sts_code` and `pts_code` validators
- In `vin_code`, `body_code`, `chassis_code`, `grz_code`, `sts_code` and `pts_code` validators added type validation

## v5.0.0

### Added

- Laravel `12.x` support
- Using `docker` with `compose` plugin instead of `docker-compose` for test environment

## v4.0.0

### Changed

- Minimal valid length of `chassis_code` and `body_code` is 8 symbols

## v3.8.0

### Added

- Laravel `11.x` support

### Changed

- Minimal Laravel version now is `10.0`
- Version of `composer` in docker container updated up to `2.7.6`
- Updated dev dependencies

## v3.7.0

### Added

- Support Laravel `10.x`
- Support Phpunit `10.x`

### Changed

- Up minimal required `PHP` version to `8.0`
- Up minimal `phpstan` version to `1.10`
- Up `composer` version to `2.5.5`

## v3.6.0

### Added

- Support Laravel `9.x`

### Changed

- Minimal required PHP version now is `7.3`

## v3.5.0

### Added

- Support PHP `8.x`

### Changed

- Composer `2.x` is supported now

## v3.4.0

### Changed

- Laravel `8.x` is supported now
- Minimal Laravel version now is `6.0` (Laravel `5.5` LTS got last security update August 30th, 2020)
- CI completely moved from "Travis CI" to "Github Actions" _(travis builds disabled)_
- Minimal required PHP version now is `7.2`

## v3.3.0

### Changed

- Maximal `illuminate/*` packages version now is `7.*`

## v3.2.0

### Added

- `grz_code` now supports "transit" type (`ГОСТ Р 50577-93, тип 15` - `ММ000М77` and `ММ000М777`)
- Directory with config file moved from directory `src` to root (was: `./src/config`, become: `./config`)

## v3.1.0

### Changed

- Maximal `illuminate/*` packages version now is `6.*`

### Added

- GitHub actions for a tests running

## v3.0.0

### Added

- Docker-based environment for development
- Project `Makefile`

### Changed

- Minimal `PHP` version now is `^7.1.3`
- Minimal `Laravel` version now is `5.5.x`
- Maximal `Laravel` version now is `5.8.x`
- Dependency `laravel/framework` changed to `illuminate/*`
- Composer scripts
- `\AvtoDev\ExtendedLaravelValidator\ExtendedValidatorServiceProvider` &rarr; `\AvtoDev\ExtendedLaravelValidator\ServiceProvider`
- `ValidationExtensionInterface` methods signatures

## v2.2.0

### Added

- Validator extension of `cadastral numbers`

## v2.1.0

### Changed

- Maximal PHP version now is undefined
- Maximal `laravel/framework` version now is `5.7.*`
- CI changed to [Travis CI][travis]
- [CodeCov][codecov] integrated
- Issue templates updated

[travis]:https://travis-ci.org/
[codecov]:https://codecov.io/

## v2.0.0

### Added

- Package config file. That can extends package validator extensions

### Changed

- `grz_code` extension now follows `ГОСТ Р 50577-93` excepts "transit" and "diplomatic" numbers formats (be careful - this changes can break your previous code)

### Fixed

- `body_code`, `driver_license_number` and `sts_code` regular expressions (added `i` modifier)

### Removed

- Constant `SERVICE_PROVIDER_REGISTERED_ABSTRACT` from `ExtendedValidatorServiceProvider`
- Laravel DI instance `extended-laravel-validator.registered`

## v1.2.0

### Changed

- CI config updated
- Package PHPUnit minimal version now is `5.7.10`
- Unimportant PHPDoc blocks removed
- Code a little bit refactored

## v1.1.2

### Changed

- Validator rule `driver_license_number` now use **only russians numbers format**

## v1.1.1

### Added

- Now supported `grz` codes, used in taxi

## v1.1.0

### Added

- Validator rule `driver_license_number`

[keepachangelog]:https://keepachangelog.com/en/1.0.0/
[semver]:https://semver.org/spec/v2.0.0.html
