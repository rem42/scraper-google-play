<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
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
        $this->assertInstanceOf(GooglePlayBook::class, $result[0]);
    }
}
