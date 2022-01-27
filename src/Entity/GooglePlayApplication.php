<?php

namespace Scraper\ScraperGooglePlay\Entity;

final class GooglePlayApplication extends GooglePlayObject
{
    public GooglePlayDeveloper $developer;
    public GooglePlayCategory $category;
    public string $downloadRange;
    public int $download;
}
