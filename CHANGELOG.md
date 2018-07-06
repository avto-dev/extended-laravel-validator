# Changelog

## v2.0.0

### Changed

- `grz` codes now follows `ГОСТ Р 50577-93` (be careful - this changes can break your previous code)

### Fixed

- `body_code`, `driver_license_number` and `sts_code` a little bit fixed

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
