<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity\Shared;

class Permission
{
    public ?string $name = null;
    public ?string $code = null;
    public ?string $icon = null;
    /** @var array<int, string> */
    public array $list = [];
}
