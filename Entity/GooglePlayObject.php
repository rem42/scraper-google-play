<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayObject
 * @package Scraper\ScraperGooglePlay\Entity
 */
abstract class GooglePlayObject
{
	/**
	 * @var string
	 */
	protected $id;
	
	/**
	 * @var string
	 */
	protected $link;
	
	/**
	 * @var string
	 */
	protected $cover;
	
	/**
	 * @var string
	 */
	protected $name;
	
	/**
	 * @var string
	 */
	protected $price;
	
	/**
	 * @var string
	 */
	protected $description;
	
	/**
	 * @var string
	 */
	protected $rating;
	
	/**
	 * @var string
	 */
	protected $ratingCount;
	
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
	public function getLink()
	{
		return $this->link;
	}
	
	/**
	 * @param string $link
	 *
	 * @return $this
	 */
	public function setLink($link)
	{
		$this->link = $link;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCover()
	{
		return $this->cover;
	}
	
	/**
	 * @param string $cover
	 *
	 * @return $this
	 */
	public function setCover($cover)
	{
		$this->cover = $cover;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getName()
	{
		return $this->name;
	}
	
	/**
	 * @param string $name
	 *
	 * @return $this
	 */
	public function setName($name)
	{
		$this->name = $name;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getPrice()
	{
		return $this->price;
	}
	
	/**
	 * @param string $price
	 *
	 * @return $this
	 */
	public function setPrice($price)
	{
		$this->price = $price;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getDescription()
	{
		return $this->description;
	}
	
	/**
	 * @param string $description
	 *
	 * @return $this
	 */
	public function setDescription($description)
	{
		$this->description = $description;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getRating()
	{
		return $this->rating;
	}
	
	/**
	 * @param string $rating
	 *
	 * @return $this
	 */
	public function setRating($rating)
	{
		$this->rating = $rating;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getRatingCount()
	{
		return $this->ratingCount;
	}
	
	/**
	 * @param string $ratingCount
	 *
	 * @return $this
	 */
	public function setRatingCount($ratingCount)
	{
		$this->ratingCount = $ratingCount;
		
		return $this;
	}
}
