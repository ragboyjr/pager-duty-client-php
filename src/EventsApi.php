<?php

namespace Ragboyjr\PagerDuty;

interface EventsApi {
    const ACTION_TRIGGER = 'trigger';
    const ACTION_ACKNOWLEDGE = 'awknowledge';
    const ACTION_RESOLVE = 'resolve';

    const SEVERITY_CRITICAL = 'critical';
    const SEVERITY_ERROR = 'error';
    const SEVERITY_WARNING = 'warning';
    const SEVERITY_INFO = 'info';

    public function enqueue($routing_key, $event_action, array $payload, array $extra = []);
}
