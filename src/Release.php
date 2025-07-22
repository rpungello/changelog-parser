<?php

namespace Rpungello\ChangelogParser;

use DateTimeInterface;

class Release
{
    /**
     * @param string $version
     * @param DateTimeInterface $date
     * @param Change[] $changes
     */
    public function __construct(public string $version, public DateTimeInterface $date, public array $changes = [])
    {
    }

    public function addChange(Change $change): void
    {
        $this->changes[] = $change;
    }
}
