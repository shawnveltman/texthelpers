# This is my package texthelpers

[![Latest Version on Packagist](https://img.shields.io/packagist/v/shawnveltman/texthelpers.svg?style=flat-square)](https://packagist.org/packages/shawnveltman/texthelpers)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/shawnveltman/texthelpers/run-tests?label=tests)](https://github.com/shawnveltman/texthelpers/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/shawnveltman/texthelpers/Check%20&%20fix%20styling?label=code%20style)](https://github.com/shawnveltman/texthelpers/actions?query=workflow%3A"Check+%26+fix+styling"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/shawnveltman/texthelpers.svg?style=flat-square)](https://packagist.org/packages/shawnveltman/texthelpers)

This is where your description should go. Limit it to a paragraph or two. Consider adding a small example.

## Installation

You can install the package via composer:

```bash
composer require shawnveltman/texthelpers
```

## Usage

```php
use \Shawnveltman\Texthelpers\TextTrait;
```

## Methods
This package contains a trait with the following functions:

```
stripEverythingButNumbersAndPeriods

stripEverythingButNumbers

money_from_cents
Takes in a string or integer with no decimal point (12345), and returns it formatted as a dollar string ($123.45) 

money_from_dollars
Takes in a string or integer with a decimal point (123.45), and returns it formatted as a dollar string ($123.45)

format_phone_number
Formats a 10 digit phone number as (xxx) xxx-xxxx (also strips leading 1s)

get_twilio_formatted_number
Adds a +1 to a 10 digit phone number (+1xxxxxxxxxx)

get_ten_digit_phone_number

format_postal_code
Splits a 6 digit string into 2 3 digit components (A1B 2C3)

```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Shawn Veltman](https://github.com/shawnveltman)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
