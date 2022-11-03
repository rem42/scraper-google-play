<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\Shared\Developer;
use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Entity\Shared\Rating;

final class GooglePlaySearchAppApi extends AbstractApi
{
    /**
     * @return array<int, GooglePlayApp>
     */
    public function execute(): array
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array $apps */
        $apps = $content[0][1][0][0][0];

        $data = [];

        foreach ($apps as $app) {
            $a = new GooglePlayApp();

            $a->id = $app[12][0] ?? null;
            $a->packageName = $app[12][0] ?? null;
            $a->name = $app[2] ?? null;

            if (isset($app[1][1][0])) {
                $image = new Image();
                $image->url = $app[1][1][0][3][2];
                $image->height = $app[1][1][0][2][0] ?? null;
                $image->width = $app[1][1][0][2][1] ?? null;
                $a->cover = $image;
            }

            $a->description = $app[4][1][1][1][1] ?? null;
            $a->link = $app[9][4][2] ?? null;

            if (isset($app[6][0][2][1][0])) {
                $rating = new Rating();
                $rating->note = $app[6][0][2][1][0] ?? null;
                $rating->noteFloat = $app[6][0][2][1][1] ?? null;
                $a->rating = $rating;
            }

            if (isset($app[4][0][0][0])) {
                $d = new Developer();
                $d->name = $app[4][0][0][0] ?? null;
                $d->link = $app[4][0][0][1][4][2] ?? null;
                $a->developer = $d;
            }

            foreach ($app[1][1] as $image) {
                $i = new Image();
                $i->url = $image[3][2];
                $i->height = $image[2][0] ?? null;
                $i->width = $image[2][1] ?? null;
                $a->images[] = $i;
            }

            $offer = new Offer();
            $offer->price = $app[7][0][3][2][1][0][0] ?? null;

            if ($offer->price > 0) {
                $offer->type = Offer::$PAID;
                $offer->priceFormatted = $app[7][0][3][2][1][0][2] ?? null;
                $offer->currency = $app[7][0][3][2][1][0][1] ?? null;
                $offer->buyLink = $app[7][0][3][2][6][5][2] ?? null;
            }
            $a->offer = $offer;

            $data[] = $a;
        }

        return $data;
    }
}
