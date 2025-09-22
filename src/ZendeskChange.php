<?php

namespace Rpungello\ChangelogParser;

use InvalidArgumentException;

class ZendeskChange extends Change
{
    public int $ticketNumber;

    public string $zendeskDomain;

    public string $zendeskUrl;

    public function __construct(string $text)
    {
        parent::__construct($text);

        $this->ticketNumber = $this->extractTicketNumber($text);
        $this->zendeskDomain = $this->extractZendeskDomain($text);
        $this->zendeskUrl = "https://$this->zendeskDomain.zendesk.com/agent/tickets/$this->ticketNumber";
    }

    public static function appliesToChangeText(string $text): bool
    {
        return preg_match('/\[\d+]\(https:\/\/\w+\.zendesk.com/', $text);
    }

    public function description(): string
    {
        return preg_replace('/.*\[\d+]\(https:\/\/\w+\.zendesk\.com\/agent\/tickets\/\d+\)\s?-\s?/', '', $this->text);
    }

    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'ticket_number' => $this->ticketNumber,
            'zendesk_domain' => $this->zendeskDomain,
            'zendesk_url' => $this->zendeskUrl,
        ]);
    }

    private function extractTicketNumber(string $text): int
    {
        if (preg_match('/\[(\d+)]/', $text, $matches)) {
            return (int) $matches[1];
        }

        throw new InvalidArgumentException('No ticket number found in the text.');
    }

    private function extractZendeskDomain(string $text): string
    {
        if (preg_match('/([a-zA-Z0-9-]+)\.zendesk\.com/', $text, $matches)) {
            return $matches[1];
        }

        throw new InvalidArgumentException('No Zendesk domain found in the text.');
    }
}
