<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Entity\Shared\Author;
use Scraper\ScraperGooglePlay\Entity\Shared\Image;
use Scraper\ScraperGooglePlay\Entity\Shared\Offer;

final class GooglePlaySearchBookApi extends AbstractApi
{
    /**
     * @return array<int, GooglePlayBook>
     */
    public function execute(): array
    {
        /** @var array $content */
        $content = json_decode(substr($this->response->getContent(), 6), false);

        /** @var array $content */
        $content = json_decode($content[0][2], false);

        /** @var array $categories */
        $categories = $content[0][1];

        $data = [];

        foreach ($categories as $category) {
            $books = $category[0][0];

            foreach ($books as $book) {
                $a = new GooglePlayBook();

                $a->id = $book[12][0] ?? null;
                $a->name = $book[2] ?? null;

                if (isset($book[1][1][0])) {
                    $image = new Image();
                    $image->url = $book[1][1][0][3][2] ?? null;
                    $image->height = $book[1][1][0][2][0] ?? null;
                    $image->width = $book[1][1][0][2][1] ?? null;
                    $a->cover = $image;
                }

                $author = new Author();
                $author->name = $book[4][0][0][0] ?? null;
                $a->author = $author;

                $a->description = $book[4][1][1][1][1] ?? null;

                $offer = new Offer();
                $offer->price = $book[7][0][3][2][1][0][0] ?? null;

                if ($offer->price > 0) {
                    $offer->type = Offer::$PAID;
                    $offer->priceFormatted = $book[7][0][3][2][1][0][2] ?? null;
                    $offer->currency = $book[7][0][3][2][1][0][1] ?? null;
                    $offer->buyLink = $book[7][0][3][2][6][5][2] ?? null;
                }
                $a->offer = $offer;

                $data[] = $a;
            }
        }

        return $data;
    }
}
