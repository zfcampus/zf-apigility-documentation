# Changelog

All notable changes to this project will be documented in this file, in reverse chronological order by release.

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
- [#41](https://github.com/zfcampus/zf-apigility-documentation/pull/41) updates
  the `ApiFactory` to ensure that if an entity has no collection associated with
  it, documentation will not attempt to retrieve the fields.
