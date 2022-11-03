<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

use Scraper\ScraperGooglePlay\Entity\Shared\Author;

final class GooglePlayBook extends GooglePlayObject
{
    public ?Author $author = null;
    public ?int $pageCount = null;
    public ?string $publisher = null;
    public ?string $isbn = null;
}
