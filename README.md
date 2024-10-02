# Lithe Env

A simple environment variable loader and manager for PHP applications.

## Installation

You can install the `lithemod/env` package via Composer. Run the following command in your terminal:

```bash
composer require lithemod/env
```

## Usage

### Loading Environment Variables

To load environment variables from a `.env` file, use the `load` method:

```php
use Lithe\Support\Env;

// Load environment variables from the specified path
Env::load(__DIR__);
```

### Getting Environment Variables

To retrieve the value of an environment variable, use the `get` method:

```php
$value = Env::get('MY_VARIABLE', 'default_value');
```

### Setting Environment Variables

To set an environment variable, use the `set` method:

```php
Env::set('MY_VARIABLE', 'my_value');
```

### Checking if an Environment Variable Exists

You can check if an environment variable is defined using the `has` method. It accepts either a string or an array of keys:

```php
if (Env::has('MY_VARIABLE')) {
    // The environment variable is defined
}

if (Env::has(['VAR_ONE', 'VAR_TWO'])) {
    // At least one of the variables is defined
}
```

## Example

Here’s a quick example of how to use the `Env` class in your application:

```php
require 'vendor/autoload.php';

use Lithe\Support\Env;

// Load the .env file
Env::load(__DIR__);

// Get a variable
$dbHost = Env::get('DB_HOST', 'localhost');
echo "Database Host: " . $dbHost;

// Set a variable
Env::set('MY_VARIABLE', 'Hello, World!');

// Check if a variable exists
if (Env::has('MY_VARIABLE')) {
    echo "MY_VARIABLE is set!";
}
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for more information.