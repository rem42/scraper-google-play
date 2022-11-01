<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Media;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;

abstract class GooglePlayObject
{
    public ?string $id = null;
    public ?string $name = null;
    public ?\DateTimeInterface $releaseDate = null;
    public ?string $description = null;
    public ?string $shortDescription = null;
    /** @var array<int, Image> */
    public array $images = [];
    public ?Media $video = null;
    public ?int $type = null;
    public ?string $link = null;
    public ?Offer $offer = null;
    /** @var array<int, string> */
    public array $genres = [];
    /** @var array<int, string> */
    public array $categories = [];
}
