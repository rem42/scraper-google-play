<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Entity\Shared\Author;
use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;
use Scraper\ScraperGooglePlay\Entity\Shared\Rating;
use Scraper\ScraperGooglePlay\Entity\Shared\RatingDistribution;
use Scraper\ScraperGooglePlay\Utils\ScriptData;

final class GooglePlayBookApi extends AbstractApi
{
    public function execute(): GooglePlayBook
    {
        $content = ScriptData::extract($this->response->getContent(), 'ds:4');

        /** @var array<int, array<mixed>> $app */
        $app = $content[1][0]['8'];

        $a = new GooglePlayBook();

        $a->id = $this->extractId($app);
        $a->name = $app[0][0] ?? null;
        $a->description = $app[6][0][1] ?? null;
        $a->pageCount = $app[13][0] ?? null;

        if (isset($app[5])) {
            $author = new Author();
            $author->name = $app[5][4] ?? null;
            $author->description = $app[5][0][1] ?? null;

            if (isset($app[5][2][3][2])) {
                $image = new Image();
                $image->url = $app[5][2][3][2];
                $author->images[] = $image;
            }

            if (isset($app[5][3][3][2])) {
                $image = new Image();
                $image->url = $app[5][3][3][2];
                $author->images[] = $image;
            }
            $a->author = $author;
        }

        if (isset($app[8][0][3][2])) {
            $image = new Image();
            $image->url = $app[8][0][3][2];
            $image->height = $app[8][0][2][0] ?? null;
            $image->width = $app[8][0][2][1] ?? null;
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

        $a->publisher = $app[12][0] ?? null;

        if (isset($app[12][1])) {
            $releaseDate = \DateTime::createFromFormat('Y-m-d', $app[12][1]);
            $a->releaseDate = false !== $releaseDate ? $releaseDate : null;
        }

        if (isset($app[12][2])) {
            $a->isbn = str_replace('ISBN:', '', $app[12][2]);
        }

        // $app[14] -> Serie

        if (isset($app[26][0])) {
            foreach ($app[26][0] as $item) {
                $a->categories[] = $item[0];
            }
        }

        unset($content, $app, $item);

        return $a;
    }

    /**
     * The book id is not part of the record itself: it is read from the reader link (".../books/reader?id=...").
     *
     * @param array<mixed> $app
     */
    private function extractId(array $app): ?string
    {
        $readerUrl = $app[41][0][5][2] ?? null;

        if (!\is_string($readerUrl)) {
            return null;
        }

        parse_str((string) parse_url($readerUrl, \PHP_URL_QUERY), $query);

        return \is_string($query['id'] ?? null) ? $query['id'] : null;
    }
}
