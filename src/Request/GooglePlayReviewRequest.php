<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\Scraper;
use Scraper\ScraperGooglePlay\Exception\GoogleArgumentOutOfRangeException;

/**
 * @Scraper(path="store/getreviews", method="POST", responseAdapter="Scraper\ScraperGooglePlay\Mediator\GooglePlayMediator", scheme="HTTPS")
 */
class GooglePlayReviewRequest extends GooglePlayRequest
{
    protected int $reviewType = 0;
    protected int $pageNum    = 0;
    protected string $id;
    /**
     * 0 : Recent
     * 1 : Rating
     * 2 : Utility
     */
    protected int $reviewSortOrder = 1;
    protected int $xhr             = 1;
    protected string $hl;
    protected string $fn;

    public function getBody(): array
    {
        return [
            'reviewType' => $this->reviewType,
            'pageNum' => $this->pageNum,
            'id' => $this->id,
            'reviewSortOrder' => $this->reviewSortOrder,
            'xhr' => $this->xhr,
            'hl' => $this->hl,
        ];
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function setHl(string $hl): self
    {
        $this->hl = $hl;

        return $this;
    }

    public function setReviewSortOrder(int $reviewSortOrder): self
    {
        $possibleValue = [0, 1, 2];

        if (!in_array($reviewSortOrder, $possibleValue)) {
            throw new GoogleArgumentOutOfRangeException('Reviews Sort Order must be one of : ' . implode(', ', $possibleValue));
        }
        $this->reviewSortOrder = $reviewSortOrder;

        return $this;
    }
}
