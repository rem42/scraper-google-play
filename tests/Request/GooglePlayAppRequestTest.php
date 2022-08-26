<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Request\GooglePlayAppRequest;

/**
 * @internal
 */
final class GooglePlayAppRequestTest extends AbtractRequestTest
{
    public function testGooglePlayAppRequest(): void
    {
        $client = $this->getClient('app.txt');

        $request = new GooglePlayAppRequest();
        $request
            ->setLanguage('fr')
            ->setId('fr.reliefmaps.app')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayApp::class, $result);
    }
}
