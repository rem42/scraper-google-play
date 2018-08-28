<?php

namespace Scraper\ScraperGooglePlay\Entity;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Class GooglePlayApp
 * @package Scraper\ScraperGooglePlay\Entity
 */
class GooglePlayApp extends GooglePlayObject
{
	/**
	 * @var string
	 */
	protected $shortDescription;
	/**
	 * @var string
	 */
	protected $developer;
	
	/**
	 * @var string
	 */
	protected $category;
	
	/**
	 * @var string
	 */
	protected $lastUpdated;
	
	/**
	 * @var string
	 */
	protected $size;
	
	/**
	 * @var string
	 */
	protected $installs;
	
	/**
	 * @var string
	 */
	protected $currentVersion;
	
	/**
	 * @var string
	 */
	protected $requireAndroidVersion;
	
	/**
	 * @var array
	 */
	protected $contentRating;
	
	/**
	 * @var string
	 */
	protected $interactiveElements;
	
	/**
	 * @var ArrayCollection
	 */
	protected $permissions;
	
	/**
	 * @var ArrayCollection
	 */
	protected $images;
	
	/**
	 * GooglePlayApp constructor.
	 */
	public function __construct() {
		$this->permissions = new ArrayCollection();
		$this->images = new ArrayCollection();
	}
	
	/**
	 * @return string
	 */
	public function getShortDescription()
	{
		return $this->shortDescription;
	}
	
	/**
	 * @param string $shortDescription
	 *
	 * @return $this
	 */
	public function setShortDescription($shortDescription)
	{
		$this->shortDescription = $shortDescription;
		
		return $this;
	}
	
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
		$this->category = $category;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getLastUpdated()
	{
		return $this->lastUpdated;
	}
	
	/**
	 * @param string $lastUpdated
	 *
	 * @return $this
	 */
	public function setLastUpdated($lastUpdated)
	{
		$this->lastUpdated = $lastUpdated;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getSize()
	{
		return $this->size;
	}
	
	/**
	 * @param string $size
	 *
	 * @return $this
	 */
	public function setSize($size)
	{
		$this->size = $size;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getInstalls()
	{
		return $this->installs;
	}
	
	/**
	 * @param string $installs
	 *
	 * @return $this
	 */
	public function setInstalls($installs)
	{
		$this->installs = $installs;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getCurrentVersion()
	{
		return $this->currentVersion;
	}
	
	/**
	 * @param string $currentVersion
	 *
	 * @return $this
	 */
	public function setCurrentVersion($currentVersion)
	{
		$this->currentVersion = $currentVersion;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getRequireAndroidVersion()
	{
		return $this->requireAndroidVersion;
	}
	
	/**
	 * @param string $requireAndroidVersion
	 *
	 * @return $this
	 */
	public function setRequireAndroidVersion($requireAndroidVersion)
	{
		$this->requireAndroidVersion = $requireAndroidVersion;
		
		return $this;
	}
	
	/**
	 * @return array
	 */
	public function getContentRating()
	{
		return $this->contentRating;
	}
	
	/**
	 * @param array $contentRating
	 *
	 * @return $this
	 */
	public function setContentRating($contentRating)
	{
		$this->contentRating = $contentRating;
		
		return $this;
	}
	
	/**
	 * @return string
	 */
	public function getInteractiveElements()
	{
		return $this->interactiveElements;
	}
	
	/**
	 * @param string $interactiveElements
	 *
	 * @return $this
	 */
	public function setInteractiveElements($interactiveElements)
	{
		$this->interactiveElements = $interactiveElements;
		
		return $this;
	}
	
	/**
	 * @return ArrayCollection
	 */
	public function getPermissions()
	{
		return $this->permissions;
	}
	
	/**
	 * @param ArrayCollection $permissions
	 *
	 * @return $this
	 */
	public function setPermissions($permissions)
	{
		$this->permissions = $permissions;
		
		return $this;
	}
	
	/**
	 * @param GooglePlayPermissions $permissions
	 */
	public function addPermissions(GooglePlayPermissions $permissions){
		$this->permissions->add($permissions);
	}
	
	/**
	 * @return ArrayCollection
	 */
	public function getImages()
	{
		return $this->images;
	}
	
	/**
	 * @param ArrayCollection $images
	 *
	 * @return $this
	 */
	public function setImages($images)
	{
		$this->images = $images;
		
		return $this;
	}
	
	/**
	 * @param GooglePlayImage $image
	 */
	public function addImages(GooglePlayImage $image){
		$this->images->add($image);
	}
}
