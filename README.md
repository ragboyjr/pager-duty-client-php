# Pager Duty API Client

Simple PHP Client for interacting with the Pager Duty API.

## Installation

Install with composer at `ragboyjr/pager-duty-client-client`

## Usage

```php
<?php

use Ragboyjr\PagerDuty;

$events = new PagerDuty\GuzzleEventsApiClient(/* pass an optional custom GuzzleHttp\ClientInterface */);

$resp = $events->enqueue($routing_key, PagerDuty\EventsApi::ACTION_TRIGGER, [
    'summary' => 'My Alert Summary',
    'source' => 'sub.host.com',
    'severity' => PagerDuty\EventsApi::SEVERITY_INFO,
]);

if ($resp->isOk()) {
    var_dump($resp->getBody());
} else if ($resp->isError()) {
    var_dump($resp->getStatus());
    var_dump($resp->getBody());
    var_dump($resp->getHttpResponse());
}
```
