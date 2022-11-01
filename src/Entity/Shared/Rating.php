<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity\Shared;

class Rating
{
    public ?string $note = null;
    public ?float $noteFloat = null;
    /** @var array<int, RatingDistribution> */
    public array $distribution = [];
}
