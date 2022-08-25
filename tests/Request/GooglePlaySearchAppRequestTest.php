<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlaySearchApp;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchAppRequest;

/**
 * @internal
 */
final class GooglePlaySearchAppRequestTest extends AbtractRequestTest
{
    public function testAllocineMovieRequest(): void
    {
        $client = $this->getClient('search_app.json');

        $request = new GooglePlaySearchAppRequest();
        $request
            ->setLanguage('fr')
            ->setQuery('hulk')
        ;

        $result = $client->send($request);

        $this->assertIsArray($result);
        $this->assertInstanceOf(GooglePlaySearchApp::class, $result[0]);
    }
}
