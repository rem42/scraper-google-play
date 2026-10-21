<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchAppRequest;

/**
 * @internal
 */
final class GooglePlaySearchAppRequestTest extends AbstractRequestTestCase
{
    public function testGooglePlaySearchAppRequest(): void
    {
        $client = $this->getClient('search_app.txt');

        $request = new GooglePlaySearchAppRequest();
        $request
            ->setLanguage('fr')
            ->setQuery('gps')
        ;

        $result = $client->send($request);

        $this->assertIsArray($result);
        $this->assertInstanceOf(GooglePlayApp::class, $result[0]);
    }

    public function testGooglePlaySearchAppRequestEscapesQuery(): void
    {
        $request = new GooglePlaySearchAppRequest();
        $request
            ->setLanguage('fr')
            ->setCountry('fr')
            ->setQuery('say "hi" \o/')
        ;

        $this->assertSame(['hl' => 'fr', 'gl' => 'fr'], $request->getQuery());

        $payload = json_decode($request->getBody()['f.req'], true, 512, \JSON_THROW_ON_ERROR);
        $search = json_decode($payload[0][0][1], true, 512, \JSON_THROW_ON_ERROR);

        $this->assertSame('say "hi" \o/', $search[0][2][0]);
    }
}
