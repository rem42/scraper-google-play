<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

abstract class GooglePlayObject
{
    public ?string $packageName = null;
    public ?string $name = null;
    public ?string $releaseDate = null;
    public ?string $cover = null;
    public ?string $landscape = null;
    public ?string $description = null;
    public ?string $shortDescription = null;
    /** @var array<int, GooglePlayMedia> */
    public array $images = [];
    public ?GooglePlayMedia $video = null;
    public ?int $type = null;
    public ?string $link = null;
    public ?string $rating = null;
    public ?float $ratingFloat = null;
    public ?int $price = null;
    public ?string $priceFormatted = null;
    public ?string $currency = null;
    public ?string $buyLink = null;
}
