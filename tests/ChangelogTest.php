<?php

use Rpungello\ChangelogParser\Change;
use Rpungello\ChangelogParser\Changelog;
use Rpungello\ChangelogParser\Release;

it('can extract the newest release', function () {
    $changelog = new Changelog;

    $firstRelease = new Release('1.2.3', new DateTimeImmutable('2025-01-01 00:00:00'));
    $firstRelease->addChange(new Change('Added feature GHI'));
    $firstRelease->addChange(new Change('Added feature JKL'));
    $changelog->addRelease($firstRelease);

    $secondRelease = new Release('1.1.1', new DateTimeImmutable('2024-01-01 00:00:00'));
    $secondRelease->addChange(new Change('Added feature ABC'));
    $secondRelease->addChange(new Change('Added feature DEF'));
    $changelog->addRelease($secondRelease);

    expect($changelog->newestRelease()->version)->toBe('1.2.3');
});

it('can extract the newest release in the wrong order', function () {
    $changelog = new Changelog;

    $secondRelease = new Release('1.1.1', new DateTimeImmutable('2024-01-01 00:00:00'));
    $secondRelease->addChange(new Change('Added feature ABC'));
    $secondRelease->addChange(new Change('Added feature DEF'));
    $changelog->addRelease($secondRelease);

    $firstRelease = new Release('1.2.3', new DateTimeImmutable('2025-01-01 00:00:00'));
    $firstRelease->addChange(new Change('Added feature GHI'));
    $firstRelease->addChange(new Change('Added feature JKL'));
    $changelog->addRelease($firstRelease);

    expect($changelog->newestRelease()->version)->toBe('1.1.1');
});

it('can extract the oldest release', function () {
    $changelog = new Changelog;

    $firstRelease = new Release('1.2.3', new DateTimeImmutable('2025-01-01 00:00:00'));
    $firstRelease->addChange(new Change('Added feature GHI'));
    $firstRelease->addChange(new Change('Added feature JKL'));
    $changelog->addRelease($firstRelease);

    $secondRelease = new Release('1.1.1', new DateTimeImmutable('2024-01-01 00:00:00'));
    $secondRelease->addChange(new Change('Added feature ABC'));
    $secondRelease->addChange(new Change('Added feature DEF'));
    $changelog->addRelease($secondRelease);

    expect($changelog->oldestRelease()->version)->toBe('1.1.1');
});

it('can extract the oldest release in the wrong order', function () {
    $changelog = new Changelog;

    $secondRelease = new Release('1.1.1', new DateTimeImmutable('2024-01-01 00:00:00'));
    $secondRelease->addChange(new Change('Added feature ABC'));
    $secondRelease->addChange(new Change('Added feature DEF'));
    $changelog->addRelease($secondRelease);

    $firstRelease = new Release('1.2.3', new DateTimeImmutable('2025-01-01 00:00:00'));
    $firstRelease->addChange(new Change('Added feature GHI'));
    $firstRelease->addChange(new Change('Added feature JKL'));
    $changelog->addRelease($firstRelease);

    expect($changelog->oldestRelease()->version)->toBe('1.2.3');
});
