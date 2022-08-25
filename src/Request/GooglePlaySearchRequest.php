<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\Scraper;
use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

/**
 * @Scraper(path="_/PlayStoreUi/data/batchexecute", method="POST")
 */
final class GooglePlaySearchRequest extends GooglePlayRequest implements RequestQuery, RequestBody
{
    protected string $query;
    protected string $language = 'en';

    public function getQuery(): array
    {
        return [
            'hl' => $this->language,
        ];
    }

    public function getBody(): array
    {
        return [
            'f.req' => '[[["lGYRle","[[[],[[10,[10,50]],true,null,[96,27,4,8,57,30,110,11,16,49,1,3,9,12,104,55,56,51,10,34,31,77],[null,null,null,[[[[7,31],[[1,52,43,112,92,58,69,31,19,96,103]]]]]]],[\"' . $this->query . '\"],7,[null,1]]]",null,"2"]]]',
        ];
    }

    public function setQuery(string $query): self
    {
        $this->query = $query;
        return $this;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;
        return $this;
    }
}
