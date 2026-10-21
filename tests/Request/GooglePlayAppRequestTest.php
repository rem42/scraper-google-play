<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Request\GooglePlayAppRequest;

/**
 * @internal
 */
final class GooglePlayAppRequestTest extends AbstractRequestTestCase
{
    public function testGooglePlayAppRequest(): void
    {
        $client = $this->getClient('app.html');

        $request = new GooglePlayAppRequest();
        $request
            ->setLanguage('fr')
            ->setId('fr.reliefmaps.app')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayApp::class, $result);
        $this->assertSame('Relief Maps: Ski, Rando & Alpi', $result->name);
        $this->assertSame('fr.reliefmaps.app', $result->packageName);
        $this->assertSame('Relief Maps', $result->developer?->name);
        $this->assertSame('2019-01-21', $result->firstReleaseDate?->format('Y-m-d'));
    }

    public function testGooglePlayPaidAppRequest(): void
    {
        $client = $this->getClient('app_paid.html');

        $request = new GooglePlayAppRequest();
        $request
            ->setLanguage('fr')
            ->setCountry('fr')
            ->setId('com.mojang.minecraftpe')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayApp::class, $result);
        $this->assertSame('Minecraft', $result->name);
        $this->assertSame(Offer::$PAID, $result->offer?->type);
        $this->assertSame(6990000, $result->offer->price);
        $this->assertSame('EUR', $result->offer->currency);
        $this->assertSame(5865566, $result->rating?->count);
        $this->assertSame(42262, $result->rating->reviewCount);
        $this->assertSame(50000000, $result->downloadMin);
        $this->assertSame('8.0', $result->androidVersion);
        $this->assertSame('1.26.52.3', $result->latestVersion);
        $this->assertSame('2026-09-25', $result->releaseDate?->format('Y-m-d'));
        $this->assertSame('Violence légère', $result->pegi?->description);
        $this->assertSame('Interactivité des utilisateurs, Achats intégrés', $result->pegi->interactiveElements);
        $this->assertSame('4772240228547998649', $result->developer?->id);
        $this->assertSame('Microsoft Corporation', $result->developer->legalName);
        $this->assertSame('1 Microsoft Way, Redmond, WA 98052, United States', $result->developer->legalAddress);
        $this->assertNotNull($result->headerImage?->url);
        $this->assertNotNull($result->video?->thumbnail?->url);
        $this->assertContains('Simulation', $result->categories);
    }

    /**
     * Some pages move the blocks from index 140 into a trailing object keyed by their index + 1.
     */
    public function testGooglePlayAppRequestWithShiftedBlocks(): void
    {
        $client = $this->getClient('app_shifted.html');

        $request = new GooglePlayAppRequest();
        $request
            ->setLanguage('fr')
            ->setId('com.mojang.minecraftpe')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayApp::class, $result);
        $this->assertSame('1.26.52.3', $result->latestVersion);
        $this->assertSame('8.0', $result->androidVersion);
        $this->assertNotNull($result->changeLog);
        $this->assertSame('2026-09-25', $result->releaseDate?->format('Y-m-d'));
    }
}
