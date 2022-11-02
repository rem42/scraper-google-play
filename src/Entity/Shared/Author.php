<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity\Shared;

final class Author
{
    public ?string $name = null;
    public ?string $description = null;
    /** @var array<int, Image> */
    public array $images = [];
}
