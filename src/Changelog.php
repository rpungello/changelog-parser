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

    public function jsonSerialize(): array
    {
        return [
            'releases' => $this->releases,
        ];
    }
}
