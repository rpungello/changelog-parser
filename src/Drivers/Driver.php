<?php

namespace Rpungello\ChangelogParser\Drivers;

use Rpungello\ChangelogParser\Changelog;

abstract class Driver
{
    abstract public function parseFile(string $path, ?string $afterVersion = null): Changelog;
}
