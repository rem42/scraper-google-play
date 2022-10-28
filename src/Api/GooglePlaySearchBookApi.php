<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Api;

use Scraper\Scraper\Api\AbstractApi;
use Scraper\ScraperGooglePlay\Entity\GooglePlayBook;
use Scraper\ScraperGooglePlay\Entity\GooglePlayImage;
use Scraper\ScraperGooglePlay\Utils\Price;

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
                $a->cover = $book[1][1][0][3][2] ?? null;
                $a->description = $book[4][1][1][1][1] ?? null;
                $a->type = Price::$FREE;
                $a->link = $book[9][4][2] ?? null;
                $a->rating = $book[6][0][2][1][0] ?? null;
                $a->ratingFloat = $book[6][0][2][1][1] ?? null;

                foreach ($book[1][1] as $image) {
                    $i = new GooglePlayImage();
                    $i->url = $image[3][2];
                    $i->height = $image[2][0] ?? null;
                    $i->width = $image[2][1] ?? null;
                    $a->images[] = $i;
                }

                if (null !== $book[7] && \count($book[7])) {
                    $a->type = Price::$PAID;
                    $a->price = $book[7][0][3][2][1][0][0] ?? null;
                    $a->priceFormatted = $book[7][0][3][2][1][0][2] ?? null;
                    $a->currency = $book[7][0][3][2][1][0][1] ?? null;
                    $a->buyLink = $book[7][0][3][2][6][5][2] ?? null;
                }

                $data[] = $a;
            }
        }

        return $data;
    }
}
