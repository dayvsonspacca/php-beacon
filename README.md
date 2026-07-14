# php-beacon

Monorepo for the [Beacon]([https://github.com/dayvsonspacca](https://github.com/dayvsonspacca/beacon)) PHP packages — contracts and client implementations for publishing events to a Beacon server.

## Packages

| Package | Packagist | Description |
|---|---|---|
| [`beacon-contracts`](packages/contracts) | [dayvsonspacca/beacon-contracts](https://packagist.org/packages/dayvsonspacca/beacon-contracts) | Client interface and value objects (`Event`, `EventId`, `Token`) |
| [`beacon-guzzle-client`](packages/guzzle-client) | [dayvsonspacca/beacon-guzzle-client](https://packagist.org/packages/dayvsonspacca/beacon-guzzle-client) | Ready-to-use Guzzle implementation of the contracts |

Packages are developed here and split to read-only mirrors on every push and tag:
[php-beacon-contracts](https://github.com/dayvsonspacca/php-beacon-contracts) ·
[php-beacon-guzzle-client](https://github.com/dayvsonspacca/php-beacon-guzzle-client)

## Installation

Most users want the Guzzle client — it pulls the contracts automatically:

```bash
composer require dayvsonspacca/beacon-guzzle-client
```

To implement your own HTTP client, depend only on the contracts:

```bash
composer require dayvsonspacca/beacon-contracts
```

## Quick start

```php
use Beacon\Event;
use Beacon\Token;
use Beacon\Guzzle\GuzzleBeaconClient;

use function Psl\URL\parse;

$client = new GuzzleBeaconClient(
    parse('https://beacon.example.com/'),
    new Token('btk_your_token'),
);

$eventId = $client->publish(new Event('user.created', ['id' => 42]));

echo $eventId->value;
```

## Development

Requires PHP >= 8.4.

```bash
composer install
composer check   # format:check + lint + analyze + tests
```

Releases: tag the monorepo (`git tag v1.x.y && git push origin v1.x.y`) — the split workflow propagates the tag to every package mirror.

## License

[MIT](LICENSE)
