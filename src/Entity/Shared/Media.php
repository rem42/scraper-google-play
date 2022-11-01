<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity\Shared;

final class Media
{
    public string|int|null $id = null;
    public ?string $url = null;
    public ?string $metadata = null;
}
