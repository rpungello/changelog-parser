<?php

namespace Rpungello\ChangelogParser;

use JsonSerializable;

class Changelog implements JsonSerializable
{
    /** @var Release[] */
    public array $releases = [];

    public function addRelease(Release $release): void
    {
        $this->releases[] = $release;
    }

    public function newestRelease(): ?Release
    {
        if (empty($this->releases)) {
            return null;
        }

        return $this->releases[0];
    }

    public function oldestRelease(): ?Release
    {
        if (empty($this->releases)) {
            return null;
        }

        return $this->releases[count($this->releases) - 1];
    }

    public function jsonSerialize(): array
    {
        return [
            'releases' => $this->releases,
        ];
    }
}
