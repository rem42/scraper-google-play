<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

final class GooglePlayApp extends GooglePlayObject
{
    public string $logo;
    public ?GooglePlayPegi $pegi = null;
    public GooglePlayDeveloper $developer;
    public GooglePlayCategory $category;
    public string $downloadRange;
    public int $download;
    public ?string $changeLog = null;
    public ?string $privacyPolicyUrl = null;
    public ?string $firstReleaseDate = null;
}
