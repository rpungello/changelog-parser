<?php

namespace Rpungello\ChangelogParser;

use JsonSerializable;

class Changelog implements JsonSerializable
{
    /** @var Release[] */
    public array $releases = [];

    /**
     * Represents a collection of releases in a changelog.
     *
     * This class manages an array of Release objects and provides methods to add, retrieve,
     * and serialize the releases.
     */
    public function __construct()
    {
        $this->releases = [];
    }

    /**
     * Adds a release to the changelog.
     *
     * @param Release $release The release to add.
     *
     * @return void
     */
    public function addRelease(Release $release): void
    {
        $this->releases[] = $release;
    }

    /**
     * Returns the newest release in the changelog.
     *
     * @return Release|null The newest release or null if empty.
     */
    public function newestRelease(): ?Release
    {
        if (empty($this->releases)) {
            return null;
        }

        return $this->releases[0];
    }

    /**
     * Returns the oldest release in the changelog.
     *
     * @return Release|null The oldest release or null if empty.
     */
    public function oldestRelease(): ?Release
    {
        if (empty($this->releases)) {
            return null;
        }

        return $this->releases[count($this->releases) - 1];
    }

    /**
     * Converts the changelog to an array representation.
     *
     * @return array The array representation of the changelog.
     */
    public function jsonSerialize(): array
    {
        return [
            'releases' => $this->releases,
        ];
    }
}
