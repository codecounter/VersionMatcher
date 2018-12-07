VersionMatcher
=======

[![Build Status](https://travis-ci.com/codecounter/VersionMatcher.svg?branch=master)](https://travis-ci.com/codecounter/VersionMatcher)

Compare versions with logic opertation. (Actually, it's a project to test ci/cd)

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

Develop
=======

- Clone repository
- `cd dev`
- `cp docker-compose.example.yml docker-compose.yml`, modify it if necessary
- `docker-compose up -d`
- `docker-compose exec php bash`, ssh to the container
- `cd /var/www`

then, you can run unit test by `phpunit`, or code sniffer by `phpcs`.

`php tests/coverage-check.php` after `phpunit`, this script can exit stdout with 1
when coverage < 90%, for ci notification.

License
=======

This library is under MIT license.
