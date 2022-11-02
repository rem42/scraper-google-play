<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Entity\Shared;

class Offer
{
    public static int $FREE = 1;
    public static int $PAID = 2;

    public ?int $type = null;
    public ?int $price = null;
    public ?string $priceFormatted = null;
    public ?string $currency = null;
    public ?string $buyLink = null;

    public function __construct()
    {
        $this->type = self::$FREE;
    }
}
