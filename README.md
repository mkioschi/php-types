# Common Types

## Requirements
- PHP ^8.3

## Installation
To install this module, run the following command in your terminal:
```bash
composer require mkioschi/php-types
```

## Basic usage
```php
$email = Email::from('email@domain.com');
echo $email->getHiddenFormat(); // Output: e***l@d********m
```

## Common methods
Most type have at least the following common methods:
```php
 - public static function from(...$args)
 - public static function tryFrom(...$args)
 - public static function innFrom(...$args)
 - public static function isValid(...$args)
 - public function equals($value)
 - public function getValue(...$args)
 - public function __toString(...$args)
```

## Available Types
- Address
- Arr
- Boolean
- Byte
- Centimeter
- Cnpj
- Cpf
- Domain
- Email
- Gram
- Gigabyte
- Ip
- Kilobyte
- Kilogram
- Megabyte
- Money
- Numeric
- Ounce
- Password
- Path
- PhoneNumber
- Pound
- PostalCode
- Slug
- Str
- Url
- Uuid

## Coming soon
- CreditCard
- Duration
- Foot
- Hour
- Kilometer
- Meter
- Minute
- Percent
- Second
- Temperature