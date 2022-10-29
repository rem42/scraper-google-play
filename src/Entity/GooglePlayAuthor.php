<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

final class GooglePlayAuthor
{
    public ?string $name = null;
    public ?string $description = null;
    /** @var array<int, GooglePlayImage> */
    public array $images = [];
}
