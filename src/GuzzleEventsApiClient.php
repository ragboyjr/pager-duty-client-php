<?php

namespace Ragboyjr\PagerDuty;

use GuzzleHttp;

class GuzzleEventsApiClient implements EventsApi
{
    private $client;

    public function __construct(GuzzleHttp\ClientInterface $client = null) {
        $this->client = $client ?: new GuzzleHttp\Client([
            'base_uri' => 'https://events.pagerduty.com/v2/',
            'http_errors' => false,
        ]);
    }

    public function enqueue($routing_key, $event_action, array $payload, array $extra = []) {
        $resp = $this->client->request('POST', 'enqueue', [
            'json' => array_merge([
                'routing_key' => $routing_key,
                'event_action' => $event_action,
                'payload' => $payload,
            ], $extra),
        ]);
        return new Response($resp);
    }
}
