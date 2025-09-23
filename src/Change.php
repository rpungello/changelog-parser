<?php

namespace Rpungello\ChangelogParser;

use JsonSerializable;

/**
 * Represents a change in the changelog.
 *
 * This class holds information about a specific change including its text,
 * which describes the changes. It provides methods to generate a description
 * and convert itself to an array representation.
 */
class Change implements JsonSerializable
{
    public function __construct(public string $text) {}

    /**
     * Determines if the given text applies to change.
     *
     * @param string $text The text to check.
     *
     * @return bool True if it applies, false otherwise.
     */
    public static function appliesToChangeText(string $text): bool
    {
        return true;
    }

    /**
     * Returns a description of the change.
     *
     * @return string The description of the change text.
     */
    public function description(): string
    {
        return preg_replace('/^[\\s-]+/', '', $this->text);
    }

    /**
     * Converts the change to an array representation.
     *
     * @return array The array representation of the change.
     */
    public function jsonSerialize(): array
    {
        return [
            'text' => $this->text,
            'description' => $this->description(),
        ];
    }
}
