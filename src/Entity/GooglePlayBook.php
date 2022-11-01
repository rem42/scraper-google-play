<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

use Scraper\ScraperGooglePlay\Entity\Shared\Rating;

final class GooglePlayBook extends GooglePlayObject
{
    public ?GooglePlayAuthor $author = null;
    public ?GooglePlayImage $cover = null;
    public ?Rating $rating = null;
    public ?int $pageCount = null;
    public ?string $publisher = null;
    public ?string $isbn = null;
}
