VersionMatcher
=======

Compare versions with logic opertation.

Unit test
=========

First, install phpunit, then run command:

`phpunit --bootstrap /path/to/bootstrap /path/to/test/file`

Installation
============

1. With composer

```
{
    ...
    "require": {
        "codecounter/versionmatcher": "0.1.0"
    }
}
```

2. Without composer

```php
require "/path/to/VersionMatcher/autoload.php"
```

Usage
=====

1. Compare 2 version strings

```php
// produce `false`
\CodeCounter\VersionMatcher::test('ver >= 1.2.0', array(
    'ver' => '1.1.0'
));
```

2. Compare with logic

```php
// produce `true`
\CodeCounter\VersionMatcher::test('ver >= 1.2.0 && ver < 1.6.0', array(
    'ver' => '1.3.0'
));
```

3. Persisted object

```php
$matcher = new \CodeCounter\VersionMatcher(array(
    'android' => '1.3.0',
    'ios' => ''
));
// produce `true`
$matcher->match('ios >= 1.4.0 || android >= 1.3.0');
// produce `false`
$matcher->match('ios >= 1.4.0 || android < 1.2.0');
```
For detailed usage, please view `tests` directory.

License
=======

This library is under MIT license.
