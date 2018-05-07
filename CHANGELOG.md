# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.3.1 - TBD

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.

## 1.3.0 - 2018-05-07

### Added

- [#69](https://github.com/zfcampus/zf-apigility-documentation/pull/69) adds support for PHP 7.1 and 7.2.

- [#59](https://github.com/zfcampus/zf-apigility-documentation/pull/59) adds the ability to specify examples for fields.

### Changed

- [#62](https://github.com/zfcampus/zf-apigility-documentation/pull/62) updates the `ZF\Apigility\Documentation\Controller` to accept a `BasePath`
  view helper as a construction aregument; this is then used to prefix any generated links with
  the currently detected/configured base path to the application.

### Deprecated

- Nothing.

### Removed

- [#69](https://github.com/zfcampus/zf-apigility-documentation/pull/69) removes support for HHVM.

### Fixed

- [#59](https://github.com/zfcampus/zf-apigility-documentation/pull/59) provides a fix to configuration detection that removes an emitted
  notice when no zf-rpc and/or no zf-rest configuration is present.

- [#59](https://github.com/zfcampus/zf-apigility-documentation/pull/59) fixes the "api" route parameter constraint to accept `%` characters, which
  are often present when multi-segment namespaces are used for a given API name.

## 1.2.3 - 2016-10-11

### Added

- Nothing.

### Changed

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#49](https://github.com/zfcampus/zf-apigility-documentation/pull/49) fixes
  representation of nested collections.
- [#50](https://github.com/zfcampus/zf-apigility-documentation/pull/50) fixes
  escaping of field decriptions; previously, the template was improperly using
  `escapeTransformDescription()` instead of `agTransformDescription()`.
- [#52](https://github.com/zfcampus/zf-apigility-documentation/pull/52) fixes
  output of fields when the `allows_only_fields_in_filter` parameter is present
  for an input filter.

## 1.2.2 - 2016-08-10

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#53](https://github.com/zfcampus/zf-apigility-documentation/pull/53) fixes an

## 1.2.2 - 2016-08-10

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#53](https://github.com/zfcampus/zf-apigility-documentation/pull/53) fixes an
  import statement in the configuration file.

## 1.2.1 - 2016-08-04

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#48](https://github.com/zfcampus/zf-apigility-documentation/pull/48) updates
  the `ControllerFactory` implementation to be forwards compatible with
  zend-servicemanager v3.

## 1.2.0 - 2016-07-14

### Added

- [#43](https://github.com/zfcampus/zf-apigility-documentation/pull/43) adds
  support for v3 releases of Zend Framework components, while retaining support
  for v2 releases.
- [#43](https://github.com/zfcampus/zf-apigility-documentation/pull/43) extracts
  the `ApiFactory` factory inlined in the `Module` class to a first-class
  factory, `ZF\Apigility\Documentation\Factory\ApiFactoryFactory`.
- [#19](https://github.com/zfcampus/zf-apigility-documentation/pull/19) adds
  support for displaying documentation of APIs with nested namespaces (e.g.,
  `Company\ApiName` vs just `ApiName`). Such services are now denoted with
  dot-notation: `Company.ApiName`.
- [#35](https://github.com/zfcampus/zf-apigility-documentation/pull/35) adds
  a new view helper, `agTransformDescription()`, which will transform markdown
  descriptions to HTML. This is now used by default in the supplied view
  scripts. **This means you can now use markdown in your API descriptions!**
- [#38](https://github.com/zfcampus/zf-apigility-documentation/pull/38) updates
  the `Field` class to allow setting the field type, and updates the operation
  view script to now display field types for given operations.

### Deprecated

- Nothing.

### Removed

- [#43](https://github.com/zfcampus/zf-apigility-documentation/pull/43) removes
  support for PHP 5.5.

### Fixed

- Nothing.

## 1.1.1 - 2016-07-13

### Added

- Nothing.

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- [#39](https://github.com/zfcampus/zf-apigility-documentation/pull/39) updates
  the component to properly display information about zend-inputfilter
  Collections when displaying operation validation information.
- [#40](https://github.com/zfcampus/zf-apigility-documentation/pull/40) updates
  the Operations view script to:
  - display HTTP method-specific fields first, if present.
  - display general fields only if they exist (the fix prevents an empty row
    displaying).
  - insert a closing `</span>` tag within the table data cell containing the
    required flag.
- [#41](https://github.com/zfcampus/zf-apigility-documentation/pull/41) updates
  the `ApiFactory` to ensure that if an entity has no collection associated with
  it, documentation will not attempt to retrieve the fields.
