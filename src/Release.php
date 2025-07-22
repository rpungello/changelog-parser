<?php

namespace Rpungello\ChangelogParser;

use DateTimeInterface;

class Release
{
    /**
     * @param  Change[]  $changes
     */
    public function __construct(public string $version, public DateTimeInterface $date, public array $changes = []) {}

    public function addChange(Change $change): void
    {
        $this->changes[] = $change;
    }
}
