# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog][keepachangelog] and this project adheres to [Semantic Versioning][semver].

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

- Package config file. That can extends package validator extensions.

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
