<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
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
}
