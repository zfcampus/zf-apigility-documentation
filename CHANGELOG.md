# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

## 1.2.0 - TBD

### Added

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

- Nothing.

### Fixed

- Nothing.

## 1.1.1 - TBD

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
