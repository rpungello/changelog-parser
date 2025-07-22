<?php

namespace Rpungello\ChangelogParser;

use Rpungello\ChangelogParser\Drivers\Driver;
use Rpungello\ChangelogParser\Drivers\StandardDriver;

class ChangelogParser
{
    public static function parseChangelog(string $path, ?Driver $driver = null): Changelog
    {
        $driver = $driver ?? new StandardDriver();
        return $driver->parseFile($path);
    }
}
