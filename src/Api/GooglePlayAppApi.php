<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\Shared\Category;
use Scraper\ScraperGooglePlay\Entity\Shared\Developer;
use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Media;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Entity\Shared\Pegi;
use Scraper\ScraperGooglePlay\Entity\Shared\Permission;
use Scraper\ScraperGooglePlay\Entity\Shared\Rating;
use Scraper\ScraperGooglePlay\Entity\Shared\RatingDistribution;

final class GooglePlayAppApi extends AbstractApi
{
    public function execute(): GooglePlayApp
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array<int, array> $app */
        $app = $content[1][2];

        $a = new GooglePlayApp();
        $a->id = $app[77][0] ?? null;
        $a->name = $app[0][0] ?? null;
        $a->packageName = $app[77][0] ?? null;
        $a->description = $app[72][0][1] ?? null;
        $a->shortDescription = $app[73][0][1] ?? null;
        $a->purchaseInApp = $app[19][0] ?? null;
        $a->latestVersion = $app[140][0][0][0] ?? null;

        $a->changeLog = $app[144][1][1] ?? null;
        $a->privacyPolicyUrl = $app[99][0][5][2] ?? null;

        $a->downloadRange = $app[13][0] ?? null;
        $a->download = $app[13][2] ?? null;

        if (\is_array($app[9])) {
            $p = new Pegi();
            $p->name = $app[9][0] ?? null;
            $p->description = $app[9][3][1] ?? null;
            $m = new Image();
            $m->url = $app[9][1][3][2] ?? null;
            $m->width = $app[9][1][2][1] ?? null;
            $m->height = $app[9][1][2][0] ?? null;
            $p->media = $m;
            $a->pegi = $p;
        }

        if (isset($app[10][1][0])) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($app[10][1][0]);
            $a->firstReleaseDate = $dateTime;
        }

        if (isset($app[51][0][0])) {
            $rating = new Rating();
            $rating->note = $app[51][0][0] ?? null;
            $rating->noteFloat = $app[51][0][1] ?? null;

            foreach ($app[51][1] as $key => $value) {
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
        $offer->price = $app[57][0][0][0][0][1][0][0] ?? null;

        if ($offer->price > 0) {
            $offer->type = Offer::$PAID;
            $offer->priceFormatted = $app[57][0][0][0][0][1][0][2] ?? null;
            $offer->currency = $app[57][0][0][0][0][1][0][1] ?? null;
            $offer->buyLink = $app[57][0][0][0][0][6][5][2] ?? null;
        }
        $a->offer = $offer;

        if (\is_array($app[69])) {
            $d = new Developer();
            $d->name = $app[69][5][1] ?? null;
            $d->mail = $app[12][5][2][0] ?? null;
            $d->website = $app[69][1][0] ?? null;
            $d->address = $app[60][2][0] ?? null;
            $d->link = $app[12][5][5][4][2] ?? null;
            $a->developer = $d;
        }

        if (isset($app[74][2][0])) {
            foreach ($app[74][2][0] as $item) {
                $p = new Permission();
                $p->name = $item[0];
                $p->icon = $item[1][3][2];
                $p->code = $item[3][0];

                foreach ($item[2] as $value) {
                    $p->list[] = $value[1];
                }
                $a->permissions[] = $p;
            }
        }

        foreach ($app[78][0] as $img) {
            $i = new Image();
            $i->url = $img[3][2] ?? null;
            $i->width = $img[2][1] ?? null;
            $i->height = $img[2][0] ?? null;
            $a->images[] = $i;
        }

        if (isset($app[79][0][0][0])) {
            $c = new Category();
            $c->name = $app[79][0][0][0] ?? null;
            $c->code = $app[79][0][0][2] ?? null;
            $a->category = $c;
        }

        if (isset($app[95][0][3][2])) {
            $image = new Image();
            $image->url = $app[95][0][3][2];
            $image->height = $app[95][0][2][0] ?? null;
            $image->width = $app[95][0][2][1] ?? null;
            $a->cover = $image;
        }

        if (isset($app[100][0][0]) && \is_array($app[100][0][0])) {
            $v = new Media();
            $v->id = $app[100][0][0][2] ?? null;
            $v->url = $app[100][0][0][3][2] ?? null;
            $v->metadata = $app[100][0][0][4] ?? null;
            $a->video = $v;
        }

        if (isset($app[144][2][0])) {
            $dateTime = new \DateTime();
            $dateTime->setTimestamp($app[144][2][0]);
            $a->releaseDate = $dateTime;
        }

        return $a;
    }
}
