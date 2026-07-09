# beacon-contracts

Contracts for the Beacon event platform: the client interface and value objects. No HTTP code — bring your own client, or use [`dayvsonspacca/beacon-guzzle-client`](https://packagist.org/packages/dayvsonspacca/beacon-guzzle-client).

> Developed in the [php-beacon monorepo](https://github.com/dayvsonspacca/php-beacon); this repository is a read-only split.

## Installation

```bash
composer require dayvsonspacca/beacon-contracts
```

## What's inside

- `Beacon\ClientInterface` — `publish(Event): EventId` and `subscribe(): void`
- `Beacon\Event` — topic + data payload, validated on construction
- `Beacon\EventId` — identifier returned by a publish
- `Beacon\Token` — client authentication token

## Implementing your own client

```php
use Beacon\ClientInterface;
use Beacon\Event;
use Beacon\EventId;

final readonly class MyBeaconClient implements ClientInterface
{
    public function publish(Event $event): EventId
    {
        // POST {"topic": $event->topic, "data": $event->data} to your Beacon server
        // and wrap the returned id:
        return new EventId($idFromResponse);
    }

    public function subscribe(): void
    {
        // ...
    }
}
```

## License

[MIT](LICENSE)
