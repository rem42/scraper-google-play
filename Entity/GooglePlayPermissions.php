<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayPermissions
 * @package Scraper\ScraperGooglePlay\Entity
 */
class GooglePlayPermissions
{
	/**
	 * @var string
	 */
	protected $title;
	
	/**
	 * @var string
	 */
	protected $description;
	
	/**
	 * @return string
	 */
	public function getTitle()
	{
		return $this->title;
	}
	
	/**
	 * @param string $title
	 *
	 * @return $this
	 */
	public function setTitle($title)
	{
		$this->title = $title;
		
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
}
