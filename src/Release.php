<?php

namespace Rpungello\ChangelogParser;

use DateTimeInterface;
use JsonSerializable;

class Release implements JsonSerializable
{
    /**
     * @param  Change[]  $changes
     */
    public function __construct(public string $version, public DateTimeInterface $date, public array $changes = []) {}

    public function addChange(Change $change): void
    {
        $this->changes[] = $change;
    }

    public function jsonSerialize(): array
    {
        return [
            'version' => $this->version,
            'date' => $this->date->format('Y-m-d'),
            'changes' => $this->changes,
        ];
    }
}
