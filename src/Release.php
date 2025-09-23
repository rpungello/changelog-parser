<?php

namespace Rpungello\ChangelogParser;

use DateTimeInterface;
use JsonSerializable;

class Release implements JsonSerializable
{
    /**
     * Represents a release in the changelog.
     *
     * This class holds information about a specific release including its version,
     * date, and changes. It provides methods to add new changes to the release.
     *
     * @param  Change[]  $changes;
     */
    public function __construct(public string $version, public DateTimeInterface $date, public array $changes = []) {}

    /**
     * Adds a change to the release.
     *
     * @param  Change  $change  The change to add.
     */
    public function addChange(Change $change): void
    {
        $this->changes[] = $change;
    }

    /**
     * Converts the release to an array representation.
     *
     * @return array The array representation of the release.
     */
    public function jsonSerialize(): array
    {
        return [
            'version' => $this->version,
            'date' => $this->date->format('Y-m-d'),
            'changes' => $this->changes,
        ];
    }
}
