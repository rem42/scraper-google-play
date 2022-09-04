<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

final class GooglePlayMovieRequest extends GooglePlayRequest implements RequestQuery, RequestBody
{
    protected string $id;
    protected string $language;

    public function getQuery(): array
    {
        return [
            'hl' => $this->language,
        ];
    }

    /**
     * @return array<string, string>
     */
    public function getBody(): array
    {
        return [
            'f.req' => '[[["Ws7gDc","[null,null,[[1,4,5,6,7,8,9,10,11,12,14,15,16,19,20,22,25,27,29,30,32,34,38]],[[[true],null,[[null,[]]],null,null,null,null,[null,2],null,null,null,null,null,null,null,null,null,null,null,null,null,null,[1]],[null,[[null,[]]]],[null,[[null,[]]],null,[true]],[null,[[null,[]]]],null,null,null,null,[[[null,[]]]],[[[null,[]]]]],null,[[\"' . $this->id . '\",1]]]",null,"7"]]]',
        ];
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setLanguage(string $language): self
    {
        $this->language = $language;

        return $this;
    }
}
