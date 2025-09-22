<?php

namespace Rpungello\ChangelogParser\Drivers;

use Closure;
use Rpungello\ChangelogParser\Changelog;

abstract class Driver
{
    abstract public function parseFile(string $path, ?Closure $stopParsing = null): Changelog;
}
