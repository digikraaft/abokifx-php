# Convenient PHP wrapper to abokiFX API
![run-tests](https://github.com/digikraaft/abokifx-php/workflows/run-tests/badge.svg)
[![Build Status](https://travis-ci.com/digikraaft/abokifx-php.svg?token=6YhB5FxJsF7ENdMM7Mzz&branch=master)](https://travis-ci.com/digikraaft/abokifx-php)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/digikraaft/abokifx-php/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/digikraaft/abokifx-php/?branch=master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/digikraaft/abokifx-php/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](https://opensource.org/licenses/MIT)

This package provides an expressive and convenient way to interact with the [abokiFX API](https://https://www.abokifx.com/api_references/).
## Installation

You can install the package via composer:

```bash
composer require digikraaft/abokifx-php
```

## Usage
All APIs documented in abokiFX's [API Reference](https://https://www.abokifx.com/api_references/) are currently supported by this package.

### Authentication
Before using any of the endpoints, you will have to obtain your API token by contacting the abokiFX [marketing team](marketing@abokifx.com) via marketing@abokifx.com

### Usage

### Available Methods
A list of the available methods are documented below:

#### Abokifx
* `getApiToken() : string`
* `setApiToken(string $apiToken) : void`

#### Rate
* `current(): Array|Object`
* `parallel(): Array|Object`
* `previous(): Array|Object`
* `withDate(array params) : Array|Object`

This package returns the exact response from the abokiFX API but as the `stdClass` type.

## Testing

``` bash
composer test
```

## More Good Stuff
Check [here](https://github.com/digikraaft) for more awesome free stuff!

## Changelog
Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
Contributions are welcome! Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security
If you discover any security related issues, please email hello@digikraaft.ng instead of using the issue tracker.

## Credits

- [Tim Oladoyinbo](https://github.com/timoladoyinbo)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
