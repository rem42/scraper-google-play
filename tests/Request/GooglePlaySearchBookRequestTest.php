<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchAppRequest;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchBookRequest;

/**
 * @internal
 */
final class GooglePlaySearchBookRequestTest extends AbtractRequestTest
{
    public function testGooglePlaySearchAppRequest(): void
    {
        $client = $this->getClient('search_book.txt');

        $request = new GooglePlaySearchBookRequest();
        $request
            ->setLanguage('fr')
            ->setQuery('titeuf')
        ;

        $result = $client->send($request);

        $this->assertIsArray($result);
        $this->assertInstanceOf(GooglePlayApp::class, $result[0]);
    }
}
