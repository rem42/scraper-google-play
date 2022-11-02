<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Request\GooglePlayBookRequest;

/**
 * @internal
 */
final class GooglePlayBookRequestTest extends AbtractRequestTest
{
    public function testGooglePlayAppRequest(): void
    {
        $client = $this->getClient('book.txt');

        $request = new GooglePlayBookRequest();
        $request
            ->setLanguage('fr')
            ->setId('aXkq9-R2pwAC')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayBook::class, $result);
    }
}
