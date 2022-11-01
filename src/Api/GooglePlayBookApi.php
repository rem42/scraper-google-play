<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayAuthor;
use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Entity\GooglePlayCategory;
use Scraper\ScraperGooglePlay\Entity\GooglePlayImage;
use Scraper\ScraperGooglePlay\Entity\GooglePlayMedia;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Entity\Shared\Rating;
use Scraper\ScraperGooglePlay\Entity\Shared\RatingDistribution;

final class GooglePlayBookApi extends AbstractApi
{
    public function execute(): GooglePlayBook
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array<int, array> $app */
        $app = $content[1][7];

        $t = json_encode($app);

        $a = new GooglePlayBook();
        // $a->id = ;

        $a->name = $app[0][0] ?? null;
        $a->description = $app[6][0][1] ?? null;
        $a->pageCount = $app[13][0] ?? null;
        // $a->shortDescription = $app[73][0][1] ?? null;

        if (isset($app[5])) {
            $author = new GooglePlayAuthor();
            $author->name = $app[5][4] ?? null;
            $author->description = $app[5][0][1] ?? null;

            if (isset($app[5][2][3][2])) {
                $image = new GooglePlayImage();
                $image->url = $app[5][2][3][2];
                $author->images[] = $image;
            }

            if (isset($app[5][3][3][2])) {
                $image = new GooglePlayImage();
                $image->url = $app[5][3][3][2];
                $author->images[] = $image;
            }
            $a->author = $author;
        }

        if (isset($app[8][0][3][2])) {
            $image = new GooglePlayImage();
            $image->url = $app[8][0][3][2];
            $image->height = $app[8][0][2][0];
            $image->width = $app[8][0][2][1];
            $a->cover = $image;
        }

        if (isset($app[9][0][0])) {
            $rating = new Rating();
            $rating->note = $app[9][0][0] ?? null;
            $rating->noteFloat = $app[9][0][1] ?? null;

            foreach ($app[9][1] as $key => $value) {
                if (null === $value) {
                    continue;
                }
                $ratingDistribution = new RatingDistribution();
                $ratingDistribution->value = $key;
                $ratingDistribution->count = $value[1];
                $rating->distribution[] = $ratingDistribution;
            }
            $a->rating = $rating;
        }

        $offer = new Offer();
        $offer->price = $app[11][0][0][0][0][1][0][0] ?? null;

        if ($offer->price > 0) {
            $offer->type = Offer::$PAID;
            $offer->priceFormatted = $app[11][0][0][0][0][1][0][2] ?? null;
            $offer->currency = $app[11][0][0][0][0][1][0][1] ?? null;
            $offer->buyLink = $app[11][0][0][0][0][6][5][2] ?? null;
        }
        $a->offer = $offer;

        if (isset($app[10][1][0])) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($app[10][1][0]);
            $a->firstReleaseDate = $dateTime;
        }

        if (isset($app[144][2][0])) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($app[144][2][0]);
            $a->releaseDate = $dateTime;
        }

        /* foreach ($app[78][0] as $img) {
            $i = new GooglePlayImage();
            $i->url = $img[3][2] ?? null;
            $i->width = $img[2][1] ?? null;
            $i->height = $img[2][0] ?? null;
            $a->images[] = $i;
        } */

        /* if (isset($app[100][0][0]) && \is_array($app[100][0][0])) {
            $v = new GooglePlayMedia();
            $v->id = $app[100][0][0][2] ?? null;
            $v->url = $app[100][0][0][3][2] ?? null;
            $v->metadata = $app[100][0][0][4] ?? null;
            $a->video = $v;
        } */

        if (isset($app[16][0][11])) {
            foreach ($app[16][0][11][1] as $item) {
                $genres = explode('/', $item[0][1]);
                $a->genres = [
                    ...$a->genres,
                    ...$genres,
                ];
            }
        }

        /* if (\is_array($app[79][0][0])) {
            $c = new GooglePlayCategory();
            $c->name = $app[79][0][0][0] ?? null;
            $c->code = $app[79][0][0][2] ?? null;
            $a->category = $c;
        } */
        return $a;
    }
}
