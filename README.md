# Sendpulse API for Laravel 9

Sendpulse API package for Laravel 9

# Installation

```bash
composer require rogertiweb/sendpulse
```

Add `Rogertiweb\SendPulse\SendPulseProvider::class` to providers

**config/app.php**
```php
'providers' => [
    Rogertiweb\SendPulse\SendPulseProvider::class,
],

'aliases' => [
    'SendPulse' => Rogertiweb\SendPulse\SendPulse::class,
]
```

Publish config

```bash
php artisan vendor:publish --provider="Rogertiweb\SendPulse\SendPulseProvider" --tag="config"
```

Set the api key variables in your `.env` file

```
SENDPULSE_API_USER_ID=null
SENDPULSE_API_SECRET=null
```

# Usage API

https://sendpulse.com/en/integrations/api

```php
// From container
$api = app('sendpulse');
$books = $api->listAddressBooks();

// From facade
$books = \SendPulse::listAddressBooks();

// From dependency injection
public function getBooks(\NikitaKiselev\SendPulse\Contracts\SendPulseApi $api)
{
    $books = $api->listAddressBooks();
}
```
