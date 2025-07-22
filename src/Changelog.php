<?php

namespace Rpungello\ChangelogParser;

class Changelog
{
    /** @var Release[] */
    public array $releases = [];

    public function addRelease(Release $release): void
    {
        $this->releases[] = $release;
    }
}
