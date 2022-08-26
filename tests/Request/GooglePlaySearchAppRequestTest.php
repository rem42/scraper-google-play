<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchAppRequest;

/**
 * @internal
 */
final class GooglePlaySearchAppRequestTest extends AbtractRequestTest
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
}
