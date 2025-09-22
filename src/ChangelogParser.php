<?php

namespace Rpungello\ChangelogParser;

use Rpungello\ChangelogParser\Drivers\Driver;
use Rpungello\ChangelogParser\Drivers\StandardDriver;

class ChangelogParser
{
    /**
     * Parses the changelog file and returns a Changelog object.
     *
     * @param string $path The path to the changelog file.
     * @param Driver|null $driver Optional driver instance for parsing. Defaults to StandardDriver if not provided.
     * @return Changelog A Changelog object containing parsed data.
     */
    public static function parseChangelog(string $path, ?Driver $driver = null): Changelog
    {
        $driver = $driver ?? new StandardDriver;

        return $driver->parseFile($path);
    }

    /**
     * Parses the changelog file and returns a Changelog object filtering changes after a specific version.
     *
     * @param string $path The path to the changelog file.
     * @param string|null $afterVersion The version after which changes should be included.
     * @param Driver|null $driver Optional driver instance for parsing. Defaults to StandardDriver if not provided.
     * @return Changelog A Changelog object containing filtered parsed data.
     */
    public static function parseChangelogAfter(string $path, ?string $afterVersion = null, ?Driver $driver = null): Changelog
    {
        $driver = $driver ?? new StandardDriver;

        return $driver->parseFile($path, fn (string $version) => version_compare($version, $afterVersion, '<='));
    }
}
