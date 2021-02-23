# Discriminator

[![Latest Stable Version](https://poser.pugx.org/mastersteelblade/discriminator/v)](//packagist.org/packages/mastersteelblade/discriminator) [![Total Downloads](https://poser.pugx.org/mastersteelblade/discriminator/downloads)](//packagist.org/packages/mastersteelblade/discriminator) [![License](https://poser.pugx.org/mastersteelblade/discriminator/license)](//packagist.org/packages/mastersteelblade/discriminator)


Branch | GitHub Actions | Coverage |
------ | -------------- | -------- |
main   | ![Main Branch](https://github.com/MasterSteelblade/php-discriminator/actions/workflows/tests.yaml/badge.svg?branch=main) | [![Coverage Status](https://codecov.io/gh/MasterSteelblade/php-discriminator/branch/main/graph/badge.svg?token=G46YUYBFN8)](https://codecov.io/gh/MasterSteelblade/php-discriminator) |
dev   | ![Main Branch](https://github.com/MasterSteelblade/php-discriminator/actions/workflows/tests.yaml/badge.svg?branch=dev) | [![Coverage Status](https://codecov.io/gh/MasterSteelblade/php-discriminator/branch/dev/graph/badge.svg?token=G46YUYBFN8)](https://codecov.io/gh/MasterSteelblade/php-discriminator) |

## About

This is a simple utility class to allow developers to implement discriminators on users, similar to Discord. This allows multiple users to share the same nickname, while allowing accounts to be tied to, for example, email addresses for uniqueness. 

## Installation using Composer

```bash
composer require sonata-project/google-authenticator
```

## Usage

Discriminator is very simple to use. Below are some examples, but first, make things easier on yourself: 

```php
use Steelblade/Discriminator/Discriminator;
```
If you use another package that has a class of the same name, substitute the classes below with the full namespace. 

### Generate a discriminator

Generating a discriminator can be done in one of two ways. First, you can simply create an object without passing a parameter in. 

```php
$discriminator = new Discriminator();
```

As no parameter has been passed, it will generate one automatically, in a range of 0 to 9999 inclusive. 

You can then, if disired, get the integer value using 
```php
$intVal = $discriminator->get();
```

Alternatively, to generate a discriminator without instantiating, a static method exists to return an integer value. 

```php
$discriminator = Discriminator::generate();
```



### Loading a user from a database

Lets say a you want to display a profile page for a user, and you retrieve their information from a database. 

```php
class User {
    private $ID;
    private $emailAddress;
    public $nickname;
    public $discriminator;

    ...

    public function login($emailAddress, $password) {
        // Retrieve the user from the database and verify their password. 
        if ($successfulLogin) {
            $this->emailAddress = $databaseRow['email'];
            $this->nickname = $databaseRow['nickname'];
            $this->discriminator = new Discriminator($databaseRow['discriminator']);
        }
    }
}

```
The discriminator reads the numeric value, and creates itself accordingly. 


### Displaying a discriminator
Discriminators can be included in strings. For example:

```php
return "The discriminator for $user->nickname is $user->discriminator";
// The discriminator for Master Steelblade is 0451
```

Representations of discriminators add leading zeroes to make the length consistent.

You can also retrieve the string value statically, by providing an integer value:

```php

$integer = 47;
$discriminator = Discriminator::format($integer);
// Returns 0047 as a string
```

## License

Discriminator is provided under the MIT license.

