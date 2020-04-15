<?php

namespace Scraper\ScraperGooglePlay\Entity;

abstract class GooglePlayObject
{
    const FREE = 'free';
    const PAID = 'paid';

    public string $packageName;
    public string $name;
    public string $cover;
    public string $landscape;
    public string $description;
    public string $shortDescription;
    /** @var array<GooglePlayMedia> */
    public array $imgs = [];
    public GooglePlayMedia $video;
    public string $type;
    public string $link;
    public string $rating;
    public float $ratingFloat;
    public int $price;
    public string $priceFormatted;
    public string $currency;
    public string $buyLink;
}
