<?php

use Rpungello\ChangelogParser\Change;
use Rpungello\ChangelogParser\ChangelogParser;
use Rpungello\ChangelogParser\ZendeskChange;

it('can parse standard changes', function () {
    $changelog = ChangelogParser::parseChangelog(__DIR__ . '/examples/standard.md');
    expect($changelog->releases)->toBeArray()->toHaveCount(1)
        ->and($changelog->releases[0]->version)->toBe('1.2.3')
        ->and($changelog->releases[0]->date->format('Y-m-d'))->toBe('2025-07-22')
        ->and($changelog->releases[0]->changes)->toHaveCount(2)
        ->and($changelog->releases[0]->changes[0]->description())->toBe('Fixes for ticket 1234')
        ->and($changelog->releases[0]->changes[0])->toBeInstanceOf(Change::class)
        ->and($changelog->releases[0]->changes[1]->description())->toBe('New feature for ticket 5678')
        ->and($changelog->releases[0]->changes[1])->toBeInstanceOf(Change::class);
});

it('can parse zendesk changes', function () {
    $changelog = ChangelogParser::parseChangelog(__DIR__ . '/examples/zendesk.md');

    expect($changelog->releases)->toBeArray()->toHaveCount(1)
        ->and($changelog->releases[0]->version)->toBe('1.2.3')
        ->and($changelog->releases[0]->date->format('Y-m-d'))->toBe('2025-07-22')
        ->and($changelog->releases[0]->changes)->toHaveCount(2)
        ->and($changelog->releases[0]->changes[0]->description())->toBe('Fixes for ticket 1234')
        ->and($changelog->releases[0]->changes[0])->toBeInstanceOf(ZendeskChange::class)
        ->and($changelog->releases[0]->changes[1]->description())->toBe('New feature for ticket 5678')
        ->and($changelog->releases[0]->changes[1])->toBeInstanceOf(ZendeskChange::class);
});

it('can parse mixed changes', function () {
    $changelog = ChangelogParser::parseChangelog(__DIR__ . '/examples/mixed.md');

    expect($changelog->releases)->toBeArray()->toHaveCount(1)
        ->and($changelog->releases[0]->version)->toBe('1.2.3')
        ->and($changelog->releases[0]->date->format('Y-m-d'))->toBe('2025-07-22')
        ->and($changelog->releases[0]->changes)->toHaveCount(2)
        ->and($changelog->releases[0]->changes[0]->description())->toBe('Fixes for ticket 1234')
        ->and($changelog->releases[0]->changes[0])->toBeInstanceOf(ZendeskChange::class)
        ->and($changelog->releases[0]->changes[1]->description())->toBe('New feature for ticket 5678')
        ->and($changelog->releases[0]->changes[1])->toBeInstanceOf(Change::class);
});

it('can parse multiple releases', function () {
    $changelog = ChangelogParser::parseChangelog(__DIR__ . '/examples/multiple.md');

    expect($changelog->releases)->toBeArray()->toHaveCount(2)
        ->and($changelog->releases[0]->version)->toBe('1.2.3')
        ->and($changelog->releases[0]->date->format('Y-m-d'))->toBe('2025-07-22')
        ->and($changelog->releases[0]->changes)->toHaveCount(2)
        ->and($changelog->releases[0]->changes[0]->description())->toBe('Fixes for ticket 1234')
        ->and($changelog->releases[0]->changes[0])->toBeInstanceOf(ZendeskChange::class)
        ->and($changelog->releases[0]->changes[1]->description())->toBe('New feature for ticket 5678')
        ->and($changelog->releases[0]->changes[1])->toBeInstanceOf(ZendeskChange::class)
        ->and($changelog->releases[1]->changes[0]->description())->toBe('Fixes for ticket 1')
        ->and($changelog->releases[1]->changes[0])->toBeInstanceOf(ZendeskChange::class)
        ->and($changelog->releases[1]->changes[1]->description())->toBe('New feature for ticket 2')
        ->and($changelog->releases[1]->changes[1])->toBeInstanceOf(Change::class);
});
