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

### Deprecated

- Nothing.

### Removed

- Nothing.

### Fixed

- Nothing.
