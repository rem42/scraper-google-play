<?php

namespace Scraper\ScraperGooglePlay\Request;

use Scraper\Scraper\Annotation\UrlAnnotation;
use Scraper\ScraperGooglePlay\Exception\GoogleArgumentOutOfRangeException;

/**
 * Class GooglePlaySearchRequest
 * @package Scraper\ScraperGooglePlay\Request
 *
 * @UrlAnnotation(url="store/search", method="GET", contentType="HTML", protocol="CURL")
 */
class GooglePlaySearchRequest extends GooglePlayRequest
{
	/**
	 * @var string
	 */
	protected $query;
	/**
	 * @var string
	 */
	protected $category;
	
	/**
	 * @var int
	 */
	protected $price;
	
	/**
	 * @var int
	 */
	protected $rating;

	/**
	 * @return array
	 */
	public function getParameters(){
		return [
			'q' => $this->query,
			'c' => $this->category,
			'price' => $this->price,
			'rating' => $this->rating,
		];
	}
	
	/**
	 * @return string
	 */
	public function getQuery()
	{
		return $this->query;
	}
	
	/**
	 * @param string $query
	 *
	 * @return $this
	 */
	public function setQuery($query)
	{
		$this->query = $query;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCategory()
	{
		return $this->category;
	}
	
	/**
	 * @param string $category
	 *
	 * @return $this
	 */
	public function setCategory($category)
	{
		$possibleValue = ["apps", "movies", "music", "books", "newsstand", "devices"];
		if(!in_array($category, $possibleValue)){
			throw new GoogleArgumentOutOfRangeException("Category must be one of : ".implode(", ", $possibleValue));
		}
		$this->category = $category;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getPrice()
	{
		return $this->price;
	}
	
	/**
	 * @param int $price
	 *
	 * @return $this
	 */
	public function setPrice($price)
	{
		if($price >= 0 && $price <= 2){
			throw new GoogleArgumentOutOfRangeException("Price must be between 0 and 2");
		}
		$this->price = $price;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getRating()
	{
		return $this->rating;
	}
	
	/**
	 * @param int $rating
	 *
	 * @return $this
	 */
	public function setRating($rating)
	{
		if($rating >= 0 && $rating <= 1){
			throw new GoogleArgumentOutOfRangeException("Rating must be 0 or 1");
		}
		$this->rating = $rating;
		
		return $this;
	}
}
