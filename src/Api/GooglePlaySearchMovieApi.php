<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayCategory;
use Scraper\ScraperGooglePlay\Entity\GooglePlayDeveloper;
use Scraper\ScraperGooglePlay\Entity\GooglePlayImage;
use Scraper\ScraperGooglePlay\Entity\GooglePlayMovie;
use Scraper\ScraperGooglePlay\Utils\Price;

final class GooglePlaySearchMovieApi extends AbstractApi
{
    /**
     * @return array<int, GooglePlayMovie>
     */
    public function execute(): array
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array $movies */
        $movies = $content[0][1][0][0][0];

        $data = [];

        foreach ($movies as $movie) {
            $a = new GooglePlayMovie();

            $a->id = $movie[12][0] ?? null;
            $a->name = $movie[2] ?? null;
            $a->cover = $movie[1][1][0][3][2] ?? null;
            $a->description = $movie[4][1][1][1][1] ?? null;
            $a->type = Price::$FREE;
            $a->link = $movie[9][4][2] ?? null;
            $a->rating = $movie[6][0][2][1][0] ?? null;
            $a->ratingFloat = $movie[6][0][2][1][1] ?? null;

            $d = new GooglePlayDeveloper();
            $d->name = $movie[4][0][0][0] ?? null;
            $d->link = $movie[4][0][0][1][4][2] ?? null;
            $a->developer = $d;

            $c = new GooglePlayCategory();
            $c->name = $movie[4][0][0][0] ?? null;
            $a->category = $c;

            foreach ($movie[1][1] as $image) {
                $i = new GooglePlayImage();
                $i->url = $image[3][2];
                $i->height = $image[2][0] ?? null;
                $i->width = $image[2][1] ?? null;
                $a->images[] = $i;
            }

            if (null !== $movie[7] && \count($movie[7])) {
                $a->type = Price::$PAID;
                $a->price = $movie[7][0][3][2][1][0][0] ?? null;
                $a->priceFormatted = $movie[7][0][3][2][1][0][2] ?? null;
                $a->currency = $movie[7][0][3][2][1][0][1] ?? null;
                $a->buyLink = $movie[7][0][3][2][6][5][2] ?? null;
            }

            $data[] = $a;
        }

        return $data;
    }
}
