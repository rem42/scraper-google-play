<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity;

use Scraper\ScraperGooglePlay\Entity\Shared\Category;
use Scraper\ScraperGooglePlay\Entity\Shared\Developer;
use Scraper\ScraperGooglePlay\Entity\Shared\Pegi;

final class GooglePlayApp extends GooglePlayObject
{
    public ?string $packageName = null;
    public ?string $latestVersion = null;
    public ?Pegi $pegi = null;
    public ?Developer $developer = null;
    public ?Category $category = null;
    public array $permissions = [];
    public ?string $downloadRange = null;
    public ?int $download = null;
    public ?string $changeLog = null;
    public ?string $privacyPolicyUrl = null;
    public ?string $purchaseInApp = null;
    public ?\DateTimeInterface $firstReleaseDate = null;
}
