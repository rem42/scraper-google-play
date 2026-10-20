<?php

declare(strict_types=1);

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

final class GooglePlayAppRequest extends GooglePlayRequest implements RequestQuery, RequestBody
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
            'f.req' => '[[["Ws7gDc","[null,null,[[1,9,10,11,14,19,20,38,43,45,47,49,52,58,59,63,69,70,73,74,75,78,79,80,91,92,95,96,97,100,101,103,106,112,119,137,139,141,145,146]],[[[true],null,[[[]]],null,null,null,null,[null,2],null,null,null,null,null,null,null,null,null,null,null,null,null,null,[1]],[null,[[[]]]],[null,[[[]]],null,[true]],[null,[[[]]]],null,null,null,null,[[[[]]]],[[[[]]]]],null,[[\"' . $this->id . '\",7]]]",null,"5"]]]',
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
