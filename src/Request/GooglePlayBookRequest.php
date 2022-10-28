<?php declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

final class GooglePlayBookRequest extends GooglePlayRequest implements RequestQuery, RequestBody
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
            'f.req' => '[[["Ws7gDc", "[null,null,[[1,5,6,7,8,9,10,11,12,13,14,15,17,21,23,24,26,27,29,30,31,32,35,38,39,42]],[[[true],null,[[null,[]]],null,null,null,null,[null,2],null,null,null,null,null,null,null,null,null,null,null,null,null,null,[1]],[null,[[null,[]]]],[null,[[null,[]]],null,[true]],[null,[[null,[]]]],null,null,null,null,[[[null,[]]]],[[[null,[]]]]],null,[[\"'.$this->id.'\",9]]]", null, "3"]]]',
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
