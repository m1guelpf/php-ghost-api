# PHP Ghost API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/m1guelpf/ghost-api.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/ghost-api)
[![Software License](https://img.shields.io/github/license/m1guelpf/php-ghost-api.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/m1guelpf/php-ghost-api/master.svg?style=flat-square)](https://travis-ci.org/m1guelpf/php-ghost-api)
[![Total Downloads](https://img.shields.io/packagist/dt/m1guelpf/ghost-api.svg?style=flat-square)](https://packagist.org/packages/m1guelpf/ghost-api)

This package makes it easy to interact with [the Ghost Content API](https://docs.ghost.org/api/content/).

## Requirements

This package requires PHP >= 5.5.

## Installation

You can install the package via composer:

``` bash
composer require m1guelpf/ghost-api
```

## Usage

You must pass a Guzzle client and the API token to the constructor of `M1guelpf\GhostAPI\Ghost`.

``` php
$ghost = new \M1guelpf\GhostAPI\Ghost('YOUR_API_TOKEN');
```

or you can skip the token and use the `connect()` method later

``` php
$ghost = new \M1guelpf\GhostAPI\Ghost();

$ghost->connect('YOUR_GHOST_API_TOKEN');
```

### Posts

``` php
$ghost->getPosts($include, $fields, $filter, $limit, $page, $order, $format);

$ghost->getPost($id);

$ghost->getPostBySlug($slug);
```

### Pages

``` php
$ghost->getPages($include, $fields, $filter, $limit, $page, $order, $format);

$ghost->getPage($id);

$ghost->getPageBySlug($slug);
```

### Authors

``` php
$ghost->getAuthors($include, $fields, $filter, $limit, $page, $order);

$ghost->getAuthor($id);

$ghost->getAuthorBySlug($slug);
```

### Tags

``` php
$ghost->getTags($include, $fields, $filter, $limit, $page, $order);

$ghost->getTag($id);

$ghost->getTagBySlug($slug);
```

### Get the Guzzle Client

``` php
$ghost->getClient();
```

### Set the Guzzle Client

``` php
$client = new \GuzzleHttp\Client(); // Example Guzzle client
$ghost->setClient($client);
```
where $client is an instance of `\GuzzleHttp\Client`.

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please email soy@miguelpiedrafita.com instead of using the issue tracker.

## Credits

- [Miguel Piedrafita](https://github.com/m1guelpf)
- [All Contributors](../../contributors)

## License

The MIT License. Please see [License File](LICENSE.md) for more information.
