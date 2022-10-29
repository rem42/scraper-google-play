<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

final class GooglePlayBook extends GooglePlayObject
{
    public ?GooglePlayAuthor $author = null;
    public ?GooglePlayImage $cover = null;
    public ?GooglePlayRating $rating = null;
}
