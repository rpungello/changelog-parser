<?php

namespace Rpungello\ChangelogParser;

use InvalidArgumentException;

class ZendeskChange extends Change
{
    public int $ticketNumber;

    public string $zendeskDomain;

    public string $zendeskUrl;

    /**
     * Represents a change in the changelog related to a Zendesk ticket.
     *
     * This class extends the Change class and holds additional information about
     * a specific change, including its ticket number, Zendesk domain, and URL.
     */
    public function __construct(string $text)
    {
        parent::__construct($text);

        $this->ticketNumber = $this->extractTicketNumber($text);
        $this->zendeskDomain = $this->extractZendeskDomain($text);
        $this->zendeskUrl = "https://$this->zendeskDomain.zendesk.com/agent/tickets/$this->ticketNumber";
    }

    /**
     * Determines if the given text applies to a Zendesk change.
     *
     * @param  string  $text  The text to check.
     * @return bool True if it applies, false otherwise.
     */
    public static function appliesToChangeText(string $text): bool
    {
        return preg_match('/\[\d+]\(https:\/\/\w+\.zendesk.com/', $text);
    }

    /**
     * Returns a description of the change, excluding the Zendesk ticket details.
     *
     * @return string The description of the change text.
     */
    public function description(): string
    {
        return preg_replace('/.*\[\d+]\(https:\/\/\w+\.zendesk\.com\/agent\/tickets\/\d+\)\s?-\s?/', '', $this->text);
    }

    /**
     * Converts the Zendesk change to an array representation.
     *
     * @return array The array representation of the Zendesk change.
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'ticket_number' => $this->ticketNumber,
            'zendesk_domain' => $this->zendeskDomain,
            'zendesk_url' => $this->zendeskUrl,
        ]);
    }

    /**
     * Extracts the ticket number from the change text.
     *
     * @param  string  $text  The change text to extract the ticket number from.
     * @return int The extracted ticket number.
     *
     * @throws InvalidArgumentException if no ticket number is found in the text.
     */
    private function extractTicketNumber(string $text): int
    {
        if (preg_match('/\[(\d+)]/', $text, $matches)) {
            return (int) $matches[1];
        }

        throw new InvalidArgumentException('No ticket number found in the text.');
    }

    /**
     * Extracts the Zendesk domain from the change text.
     *
     * @param  string  $text  The change text to extract the Zendesk domain from.
     * @return string The extracted Zendesk domain.
     *
     * @throws InvalidArgumentException if no Zendesk domain is found in the text.
     */
    private function extractZendeskDomain(string $text): string
    {
        if (preg_match('/([a-zA-Z0-9-]+)\.zendesk\.com/', $text, $matches)) {
            return $matches[1];
        }

        throw new InvalidArgumentException('No Zendesk domain found in the text.');
    }
}
