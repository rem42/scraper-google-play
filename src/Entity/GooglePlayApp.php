<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

final class GooglePlayApp extends GooglePlayObject
{
    public ?string $packageName = null;
    public ?string $latestVersion = null;
    public ?string $logo = null;
    public ?GooglePlayPegi $pegi = null;
    public ?GooglePlayDeveloper $developer = null;
    public ?GooglePlayCategory $category = null;
    public ?string $downloadRange = null;
    public ?int $download = null;
    public ?string $changeLog = null;
    public ?string $privacyPolicyUrl = null;
    public ?\DateTimeInterface $firstReleaseDate = null;
}
