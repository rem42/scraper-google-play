<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

abstract class GooglePlayObject
{
    public ?string $id = null;
    public ?string $name = null;
    public ?\DateTimeInterface $releaseDate = null;
    public ?string $description = null;
    public ?string $shortDescription = null;
    /** @var array<int, GooglePlayImage> */
    public array $images = [];
    public ?GooglePlayMedia $video = null;
    public ?int $type = null;
    public ?string $link = null;
    public ?int $price = null;
    public ?string $priceFormatted = null;
    public ?string $currency = null;
    public ?string $buyLink = null;
}
