<p align="center"><picture>
  <source media="(prefers-color-scheme: dark)" srcset="https://fabrikage.nl/assets/img/logo-alt.svg">
  <img alt="Fabrikage logo" src="https://fabrikage.nl/assets/img/logo.svg">
</picture></p>

# <p align="center">fabrikage/requirements</p>

<p align="center">An elegant solution to check if your PHP application meets the requirements to run on a server.</p>

\
&nbsp;

## Requirements

Will be added soon.

## Installation

Install the package using composer:

```bash
composer require fabrikage/requirements
```

## Usage

Valid version strings are:
- `1` Major
- `1.0` Major and minor
- `1.0.0` Major, minor and patch

*Or anything that is readable by `version_compare()`.*

Valid comparators are:
- `=` Equal to
- `!=` Not equal to
- `>` Greater than
- `>=` Greater than or equal to
- `<` Less than
- `<=` Less than or equal to

The default comparator, when none is provided is `>=`.

A version string with a comparator looks like this: `>=1.0.0`.

### Example

```php
require_once __DIR__ . '/vendor/autoload.php';

use Fabrikage\Requirements;
use Fabrikage\Requirements\Requirement;

$requirements = [
    new Requirement\PHP('8.1'),
    new Requirement\PHPExtension('curl'),
    new Requirement\WordPress('6.4.1'),
    new Requirement\WordPressPlugin('woocommerce/woocommerce.php', '8.3.1'),
];

// Pass boolean to constructor to throw exceptions when requirements are not met
$validator = new Requirements\Validator(false);
$validator->addRequirements($requirements);

if (!$validator->valid()) { 
    // Throw error
}

// Or

if (!$validator()) {
    // Throw error
}

App::run();
```