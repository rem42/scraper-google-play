<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\UrlAnnotation;
use Scraper\ScraperGooglePlay\Exception\GoogleArgumentOutOfRangeException;

/**
 * Class GooglePlayReviewRequest
 * @package Scraper\ScraperGooglePlay\Request
 *
 * @UrlAnnotation(url="store/getreviews", method="POST", contentType="Scraper\ScraperGooglePlay\Mediator\GooglePlayMediator", protocol="HTTP")
 */
class GooglePlayReviewRequest extends GooglePlayRequest
{
	/**
	 * @var int
	 */
	protected $reviewType = 0;
	
	/**
	 * @var int
	 */
	protected $pageNum = 0;
	
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * 0 : Recent
	 * 1 : Rating
	 * 2 : Utility
	 * @var int
	 */
	protected $reviewSortOrder = 1;
	
	/**
	 * @var int
	 */
	protected $xhr = 1;
	
	/**
	 * @var string
	 */
	protected $hl;
	
	/**
	 * @var string
	 */
	protected $fn;

	/**
	 * @return array
	 */
	public function getBody(){
		return [
			'reviewType' => $this->reviewType,
			'pageNum' => $this->pageNum,
			'id' => $this->id,
			'reviewSortOrder' => $this->reviewSortOrder,
			'xhr' => $this->xhr,
			'hl' => $this->hl
		];
	}
	
	/**
	 * @return string
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @param string $id
	 *
	 * @return $this
	 */
	public function setId($id)
	{
		$this->id = $id;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getHl()
	{
		return $this->hl;
	}
	
	/**
	 * @param string $hl
	 *
	 * @return $this
	 */
	public function setHl($hl)
	{
		$this->hl = $hl;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getReviewSortOrder()
	{
		return $this->reviewSortOrder;
	}
	
	/**
	 * @param int $reviewSortOrder
	 *
	 * @return $this
	 */
	public function setReviewSortOrder($reviewSortOrder)
	{
		$possibleValue = [0, 1, 2];
		if(!in_array($reviewSortOrder, $possibleValue)){
			throw new GoogleArgumentOutOfRangeException("Reviews Sort Order must be one of : ".implode(", ", $possibleValue));
		}
		$this->reviewSortOrder = $reviewSortOrder;
		
		return $this;
	}
}
