<?php

use Rpungello\ChangelogParser\ZendeskChange;

it('can parse zendesk information', function () {
    $change = new ZendeskChange("- [1234](https://yourdomain.zendesk.com/agent/tickets/1234) - Fixes for ticket 1234");
    expect($change->ticketNumber)->toBe(1234)
        ->and($change->zendeskDomain)->toBe('yourdomain')
        ->and($change->description())->toBe('Fixes for ticket 1234');
});
