<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayImage
 * @package Scraper\ScraperGooglePlay\Entity
 */
class GooglePlayImage
{
	/**
	 * @var string
	 */
	protected $url;
	
	/**
	 * @var int
	 */
	protected $width;
	
	/**
	 * @var int
	 */
	protected $height;
	
	/**
	 * @return string
	 */
	public function getUrl()
	{
		return $this->url;
	}
	
	/**
	 * @param string $url
	 *
	 * @return $this
	 */
	public function setUrl($url)
	{
		$this->url = $url;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getWidth()
	{
		return $this->width;
	}
	
	/**
	 * @param int $width
	 *
	 * @return $this
	 */
	public function setWidth($width)
	{
		$this->width = $width;
		
		return $this;
	}
	
	/**
	 * @return int
	 */
	public function getHeight()
	{
		return $this->height;
	}
	
	/**
	 * @param int $height
	 *
	 * @return $this
	 */
	public function setHeight($height)
	{
		$this->height = $height;
		
		return $this;
	}
}
