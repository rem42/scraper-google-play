<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\Scraper;
use Scraper\Scraper\Request\RequestBody;
use Scraper\Scraper\Request\RequestQuery;

/**
 * @Scraper(path="_/PlayStoreUi/data/batchexecute", method="POST")
 */
class GooglePlayDetailsApplicationRequest extends GooglePlayRequest implements RequestQuery, RequestBody
{
    protected string $id;
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
            'f.req' => '[[["jLZZ2e","[[\"' . $this->id . '\",7],2]"]]]',
        ];
        return [
            'f.req' => '[[["d5UeYe","[[\"' . $this->id . '\",7]]",null,"1"],["CLXjtf","[[\"' . $this->id . '\",7]]",null,"3"],["jLZZ2e","[[\"' . $this->id . '\",7],2]",null,"5"],["MLWfjd","[[\"' . $this->id . '\",7]]",null,"6"],["n3ZQY","[null,[\"' . $this->id . '\",7]]",null,"8"],["IoIWBc","[[null,[\"' . $this->id . '\",7]]]",null,"10"],["MRTdke","[null,null,[null,[[1,[5]],true,null,[96,27,4,8,57,30,11,110,16,49,1,3,9,12,104,55,56,51,10,34,31,77],[null,null,null,[[[[7,31],[[1,52,43,112,92,58,69,31,19,96,103]]]]]]],[\"' . $this->id . '\",7]]]",null,"14"],["MRTdke","[null,null,[null,[[1,[5]],true,null,[96,27,4,8,57,30,11,110,16,49,1,3,9,12,104,55,56,51,10,34,31,77],[null,null,null,[[[[7,31],[[1,52,43,112,92,58,69,31,19,96,103]]]]]]],[\"' . $this->id . '\",7]],true]",null,"16"],["vGe1Ed","[[null,null,[[10,88]],null,null,[[\"' . $this->id . '\",7]]]]",null,"20"],["vGe1Ed","[[null,null,[[47]],null,null,[[\"' . $this->id . '\",7]]]]",null,"21"],["k8610b","[[null,[\"' . $this->id . '\",7]]]",null,"26"],["a4vCtb","[[null,[\"' . $this->id . '\",7]]]",null,"28"],["LfoW6e","[[null,[\"' . $this->id . '\",7]]]",null,"34"],["BQ0Ly","[[null,[\"' . $this->id . '\",7],[[2]]]]",null,"36"],["EdliOe","[[null,[\"' . $this->id . '\",7]]]",null,"41"],["rpyHWd","[[null,[\"' . $this->id . '\",7]]]",null,"43"],["Wwv6He","[[null,[\"' . $this->id . '\",7]]]",null,"47"],["SLkEVb","[[null,[\"' . $this->id . '\",7]]]",null,"53"],["rYsCDe","[[\"' . $this->id . '\",7]]",null,"55"],["infIlf","[[null,[\"' . $this->id . '\",7],[true]]]",null,"57"],["UsvDTd","[null,null,[1,null,[1]],[\"' . $this->id . '\",7]]",null,"59"],["UsvDTd","[null,null,[2,null,[40]],[\"' . $this->id . '\",7]]",null,"61"],["infIlf","[[null,[\"' . $this->id . '\",7]]]",null,"65"]]]',
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
