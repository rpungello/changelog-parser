<?php

namespace Rpungello\ChangelogParser\Drivers;

use DateTime;
use Rpungello\ChangelogParser\Change;
use Rpungello\ChangelogParser\Changelog;
use Rpungello\ChangelogParser\Release;
use Rpungello\ChangelogParser\ZendeskChange;
use RuntimeException;

class StandardDriver extends Driver
{
    public function parseFile(string $path): Changelog
    {
        if (! file_exists($path) || ! is_readable($path)) {
            throw new RuntimeException("File at path '$path' does not exist or is not readable.");
        }

        $fh = fopen($path, 'r');
        $changelog = new Changelog;
        $release = null;
        while (($line = fgets($fh)) !== false) {
            $line = trim($line);
            if (empty($line)) {
                continue;
            }

            // Check if this line starts a new release
            if (preg_match('/^## (\d+\.\d+\.\d+) - (\d{4}-\d{2}-\d{2})$/', $line, $matches)) {
                $changelog->addRelease(
                    $release = new Release($matches[1], DateTime::createFromFormat('Y-m-d', $matches[2]))
                );
            } elseif ($release instanceof Release) {
                if (ZendeskChange::appliesToChangeText($line)) {
                    $release->addChange(new ZendeskChange($line));
                } else {
                    $release->addChange(new Change($line));
                }
            }
        }

        return $changelog;
    }
}
