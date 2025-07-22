# Changelog Parser

[![Tests](https://img.shields.io/github/actions/workflow/status/rpungello/changelog-parser/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/rpungello/changelog-parser/actions/workflows/run-tests.yml)

Parses markdown changelog files into a structured format, making it easy to display the information within a PHP application.

## Installation

You can install the package via composer, but first you need to add my composer repository to your composer.json file:

```json
{
    "repositories": [
        {
            "type": "composer",
            "url": "https://composer.rpun.dev"
        }
    ]
}
```

Then you can install the package:

```bash
composer require rpungello/changelog-parser
```

## Usage

Changelogs must be in the correct format for this package to parse them.
Examples of this format can be found in the `tests/examples` directory.

```php
$changelog = \Rpungello\ChangelogParser\ChangelogParser::parseChangelog('/path/to/CHANGELOG.md');
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
