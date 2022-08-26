<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

final class GooglePlayReview
{
    public ?string $id = null;
    public ?string $idUser = null;
    public ?string $name = null;
    public ?string $picture = null;
    public ?string $surname = null;
    public ?string $dateTime;
    public ?string $link = null;
    public ?string $review = null;
    public ?int $note = null;
    public ?string $noteText = null;
}
