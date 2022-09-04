<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Tests\Request;

use Scraper\ScraperGooglePlay\Entity\GooglePlayMovie;
use Scraper\ScraperGooglePlay\Request\GooglePlaySearchMovieRequest;

/**
 * @internal
 */
final class GooglePlaySearchMovieRequestTest extends AbtractRequestTest
{
    public function testGooglePlaySearchMovieRequest(): void
    {
        $client = $this->getClient('search_movie.txt');

        $request = new GooglePlaySearchMovieRequest();
        $request
            ->setLanguage('fr')
            ->setQuery('uncharted')
        ;

        $result = $client->send($request);

        $this->assertIsArray($result);
        $this->assertInstanceOf(GooglePlayMovie::class, $result[0]);
    }
}
