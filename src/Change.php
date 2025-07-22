<?php

namespace Rpungello\ChangelogParser;

class Change
{
    public function __construct(public string $text)
    {
    }

    public static function appliesToChangeText(string $text): bool
    {
        return true;
    }

    public function description(): string
    {
        return preg_replace('/^[\s-]+/', '', $this->text);
    }
}
