<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayApp;
use Scraper\ScraperGooglePlay\Entity\GooglePlayAuthor;
use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Entity\GooglePlayCategory;
use Scraper\ScraperGooglePlay\Entity\GooglePlayDeveloper;
use Scraper\ScraperGooglePlay\Entity\GooglePlayImage;
use Scraper\ScraperGooglePlay\Entity\GooglePlayMedia;
use Scraper\ScraperGooglePlay\Entity\GooglePlayPegi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayRating;
use Scraper\ScraperGooglePlay\Utils\Price;

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
        //$a->id = ;

        $a->name = $app[0][0] ?? null;
        $a->description = $app[6][0][1] ?? null;
        //$a->shortDescription = $app[73][0][1] ?? null;

        if(isset($app[5])) {
            $author = new GooglePlayAuthor();
            $author->name = $app[5][4] ?? null;
            $author->description = $app[5][0][1] ?? null;
            if(isset($app[5][2][3][2])) {
                $image = new GooglePlayImage();
                $image->url = $app[5][2][3][2];
                $author->images[] = $image;
            }
            if(isset($app[5][3][3][2])) {
                $image = new GooglePlayImage();
                $image->url = $app[5][3][3][2];
                $author->images[] = $image;
            }
            $a->author = $author;
        }

        if(isset($app[8][0][3][2])) {
            $image = new GooglePlayImage();
            $image->url = $app[8][0][3][2];
            $image->height = $app[8][0][2][0];
            $image->width = $app[8][0][2][1];
            $a->cover = $image;
        }

        if(isset($app[9][0][0])) {
            $rating = new GooglePlayRating();
            $rating->note = $app[9][0][0] ?? null;
            $rating->noteFloat = $app[9][0][1] ?? null;


            $a->rating = $rating;
        }





        $a->name = $app[0][0] ?? null;

        $a->type = Price::$FREE;
        $a->price = $app[57][0][0][0][0][1][0][0] ?? null;

        if ($a->price > 0) {
            $a->type = Price::$PAID;
            $a->priceFormatted = $app[57][0][0][0][0][1][0][2] ?? null;
            $a->currency = $app[57][0][0][0][0][1][0][1] ?? null;
            $a->buyLink = $app[57][0][0][0][0][6][5][2] ?? null;
        }

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

        foreach ($app[78][0] as $img) {
            $i = new GooglePlayImage();
            $i->url = $img[3][2] ?? null;
            $i->width = $img[2][1] ?? null;
            $i->height = $img[2][0] ?? null;
            $a->images[] = $i;
        }

        if (isset($app[100][0][0]) && \is_array($app[100][0][0])) {
            $v = new GooglePlayMedia();
            $v->id = $app[100][0][0][2] ?? null;
            $v->url = $app[100][0][0][3][2] ?? null;
            $v->metadata = $app[100][0][0][4] ?? null;
            $a->video = $v;
        }

        if (\is_array($app[9])) {
            $p = new GooglePlayPegi();
            $p->name = $app[9][0] ?? null;
            $m = new GooglePlayImage();
            $m->url = $app[9][1][3][2] ?? null;
            $m->width = $img[9][1][2][1] ?? null;
            $m->height = $img[9][1][2][0] ?? null;
            $p->media = $m;
            $a->pegi = $p;
        }

        if (\is_array($app[69])) {
            $d = new GooglePlayDeveloper();
            $d->name = $app[69][5][1] ?? null;
            $d->mail = $app[12][5][2][0] ?? null;
            $d->website = $app[69][1][0] ?? null;
            $d->address = $app[60][2][0] ?? null;
            $d->link = $app[12][5][5][4][2] ?? null;
            $a->developer = $d;
        }

        if (\is_array($app[79][0][0])) {
            $c = new GooglePlayCategory();
            $c->name = $app[79][0][0][0] ?? null;
            $c->code = $app[79][0][0][2] ?? null;
            $a->category = $c;
        }
        return $a;
    }
}
