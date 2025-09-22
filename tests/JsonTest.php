<?php

use Rpungello\ChangelogParser\Change;
use Rpungello\ChangelogParser\Changelog;
use Rpungello\ChangelogParser\Release;
use Rpungello\ChangelogParser\ZendeskChange;

it('can format changelogs as JSON', function () {
    $changelog = new Changelog();
    $release = new Release('1.2.3', new DateTimeImmutable('2025-01-01 00:00:00'));
    $release->addChange(new Change('Added feature ABC'));
    $release->addChange(new Change('Added feature DEF'));
    $changelog->addRelease($release);

    expect(json_encode($changelog))->toBe('{"releases":[{"version":"1.2.3","date":"2025-01-01","changes":[{"text":"Added feature ABC","description":"Added feature ABC"},{"text":"Added feature DEF","description":"Added feature DEF"}]}]}');
});

it('can format zendesk changelogs as JSON', function () {
    $changelog = new Changelog();
    $release = new Release('1.2.3', new DateTimeImmutable('2025-01-01 00:00:00'));
    $release->addChange(new Change('Added feature ABC'));
    $release->addChange(new ZendeskChange('[1234](https://yourdomain.zendesk.com]) - Zendesk feature DEF'));
    $changelog->addRelease($release);

    expect(json_encode($changelog))->toBe('{"releases":[{"version":"1.2.3","date":"2025-01-01","changes":[{"text":"Added feature ABC","description":"Added feature ABC"},{"text":"[1234](https:\/\/yourdomain.zendesk.com]) - Zendesk feature DEF","description":"[1234](https:\/\/yourdomain.zendesk.com]) - Zendesk feature DEF","ticket_number":1234,"zendesk_domain":"yourdomain","zendesk_url":"https:\/\/yourdomain.zendesk.com\/agent\/tickets\/1234"}]}]}');
});
