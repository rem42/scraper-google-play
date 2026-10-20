<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Request\GooglePlayBookRequest;

/**
 * @internal
 */
final class GooglePlayBookRequestTest extends AbstractRequestTestCase
{
    public function testGooglePlayBookRequest(): void
    {
        $client = $this->getClient('book.html');

        $request = new GooglePlayBookRequest();
        $request
            ->setLanguage('fr')
            ->setId('aXkq9-R2pwAC')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayBook::class, $result);
        $this->assertSame('aXkq9-R2pwAC', $result->id);
        $this->assertSame("Titeuf\u{00A0}: Dieu, le sexe et les bretelles", $result->name);
        $this->assertSame('Glénat BD', $result->publisher);
        $this->assertSame(48, $result->pageCount);
        $this->assertSame('9782723477055', $result->isbn);
    }
}
