# Laradump (Free alternative of Spatie ray)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/thejenos/laradump.svg?style=flat-square)](https://packagist.org/packages/thejenos/laradump)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/thejenos/laradump-php/run-tests?label=tests)](https://github.com/thejenos/laradump-php/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/thejenos/laradump-php/Check%20&%20fix%20styling?label=code%20style)](https://github.com/thejenos/laradump-php/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/thejenos/laradump.svg?style=flat-square)](https://packagist.org/packages/thejenos/laradump)

---

## Installation

You can install the package via composer:

```bash
composer require thejenos/laradump
```

You need to install [vscode extension](https://marketplace.visualstudio.com/items?itemName=laradump.laradump) to see the dumps

```bash
## Launch VS Code Quick Open (Ctrl+P), paste the following command, and press enter.
ext install laradump.laradump
```

## Usage

```php
// Dump a variable
laradump("test");
laradump()->dump("test");

// Dump multiple variables
laradump()->dump("test", [1,2,3], User::find(1));

// Dump models
laradump()->model(User::find(1));
laradump()->model(User::find(1), User::find(2));

// Clear dump list
laradump()->clearDumps();

// Dump queries
laradump()->showQueries();
laradump()->stopShowingQueries();

// Dump logs
laradump()->showLogs();
laradump()->stopShowingLogs();

// Dump logs
laradump()->showCache();
laradump()->stopShowingCache();

// Dump mails
laradump()->mail(new TestMail());

//Many more up to come
```

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Thanura Nadun](https://github.com/TheJenos)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
