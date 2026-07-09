<?php

declare(strict_types=1);

namespace Beacon\Guzzle;

use Beacon\ClientInterface;
use Beacon\Event;
use Beacon\EventId;
use Beacon\Token;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Override;
use Psl\Json;
use Psl\Type;
use Psl\URL\URL;
use SensitiveParameter;

/**
 * Guzzle implementation of `Beacon\ClientInterface`.
 */
final readonly class GuzzleBeaconClient implements ClientInterface
{
    private Client $http;

    public function __construct(URL $url, #[SensitiveParameter] Token $token)
    {
        $this->http = new Client([
            'base_uri' => $url->toString(),
            'headers' => [
                'Authorization' => 'Bearer ' . $token->value,
            ],
        ]);
    }

    /**
     * @throws GuzzleException If the request fails.
     * @throws Json\Exception\DecodeException If the API response is not valid JSON.
     * @throws Type\Exception\CoercionException If the API response has an unexpected shape.
     * @throws Type\Exception\AssertException Never in practice; the payload id is already a non-empty string.
     */
    #[Override]
    public function publish(Event $event): EventId
    {
        $response = $this->http->post('/publish', [
            'headers' => [
                'Accept' => 'application/json',
            ],
            'json' => [
                'topic' => $event->topic,
                'data' => $event->data,
            ],
        ]);

        $payload = Json\typed((string) $response->getBody(), Type\shape([
            'eventId' => Type\non_empty_string(),
        ]));

        return new EventId($payload['eventId']);
    }

    /**
     * @throws Exception Not implemented yet.
     */
    #[Override]
    public function subscribe(): void
    {
        throw new Exception('Not implemented.');
    }
}
