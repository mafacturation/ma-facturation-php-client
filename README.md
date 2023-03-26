# MaFacturation PHP Client

This is a PHP client for the MaFacturation API. [MaFacturation](https://mafacturation.be) is a Belgian quoting & invoicing software for freelancers and small businesses, with a REST API.

## Installation

You can install the package via composer:

```bash
composer require mafacturation/php-client
```

## Usage

You can use the client like this, by passing the API key to the constructor. The API key can be found in the MaFacturation settings.

Tenancy is supported by passing the tenant ID to the constructor. The tenant ID can be found in the MaFacturation settings.

```php
use Mafacturation\Mafacturation;
$maFacturation = new Mafacturation('your-api-key', 'your-tenant-id');
//or
$maFacturation = new Mafacturation();
$maFacturation->setToken('your-api-key');
$maFacturation->setTenantId('your-tenant-id');
```

### Customers

```php
// Get all customers
$customers = $maFacturation->customers()->get();

// Get a customer by ID
$customer = $maFacturation->customers()->get(1);
