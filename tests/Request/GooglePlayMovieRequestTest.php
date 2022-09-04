<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayMovie;
use Scraper\ScraperGooglePlay\Request\GooglePlayMovieRequest;

/**
 * @internal
 */
final class GooglePlayMovieRequestTest extends AbtractRequestTest
{
    public function testGooglePlayMovieRequest(): void
    {
        $client = $this->getClient('movie.txt');

        $request = new GooglePlayMovieRequest();
        $request
            ->setLanguage('fr')
            ->setId('9rdYxF6vNPs.P')
        ;

        $result = $client->send($request);

        $this->assertInstanceOf(GooglePlayMovie::class, $result);
    }
}
