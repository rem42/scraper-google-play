<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Media;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Entity\Shared\Rating;

abstract class GooglePlayObject
{
    public ?string $id = null;
    public ?string $name = null;
    public ?Image $cover = null;
    public ?\DateTimeInterface $releaseDate = null;
    public ?string $description = null;
    public ?string $shortDescription = null;
    /** @var array<int, Image> */
    public array $images = [];
    public ?Media $video = null;
    public ?int $type = null;
    public ?string $link = null;
    public ?Rating $rating = null;
    public ?Offer $offer = null;
    /** @var array<int, string> */
    public array $genres = [];
    /** @var array<int, string> */
    public array $categories = [];
}
