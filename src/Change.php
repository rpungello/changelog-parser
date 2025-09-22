<?php

namespace Rpungello\ChangelogParser;

use JsonSerializable;

class Change implements JsonSerializable
{
    public function __construct(public string $text) {}

    public static function appliesToChangeText(string $text): bool
    {
        return true;
    }

    public function description(): string
    {
        return preg_replace('/^[\s-]+/', '', $this->text);
    }

    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'description' => $this->description(),
        ];
    }
}
