# Parses changelog based on my format

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rpungello/changelog-parser.svg?style=flat-square)](https://packagist.org/packages/rpungello/changelog-parser)
[![Tests](https://img.shields.io/github/actions/workflow/status/rpungello/changelog-parser/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rpungello/changelog-parser/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/rpungello/changelog-parser.svg?style=flat-square)](https://packagist.org/packages/rpungello/changelog-parser)

This is where your description should go. Try and limit it to a paragraph or two. Consider adding a small example.

## Support us

[<img src="https://github-ads.s3.eu-central-1.amazonaws.com/changelog-parser.jpg?t=1" width="419px" />](https://spatie.be/github-ad-click/changelog-parser)

We invest a lot of resources into creating [best in class open source packages](https://spatie.be/open-source). You can support us by [buying one of our paid products](https://spatie.be/open-source/support-us).

We highly appreciate you sending us a postcard from your hometown, mentioning which of our package(s) you are using. You'll find our address on [our contact page](https://spatie.be/about-us). We publish all received postcards on [our virtual postcard wall](https://spatie.be/open-source/postcards).

## Installation

You can install the package via composer:

```bash
composer require rpungello/changelog-parser
```

## Usage

```php
$skeleton = new Rpungello\ChangelogParser();
echo $skeleton->echoPhrase('Hello, Rpungello!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Rob Pungello](https://github.com/rpungello)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
