<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayAppSearch
 * @package Scraper\ScraperGooglePlay\Entity
 */
class GooglePlayAppSearch extends GooglePlayObject
{
	/**
	 * @var string
	 */
	protected $developer;
	
	/**
	 * @return string
	 */
	public function getDeveloper()
	{
		return $this->developer;
	}
	
	/**
	 * @param string $developer
	 *
	 * @return $this
	 */
	public function setDeveloper($developer)
	{
		$this->developer = $developer;
		
		return $this;
	}
}
