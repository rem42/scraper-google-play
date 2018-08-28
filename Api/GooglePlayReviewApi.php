<?php

namespace Scraper\ScraperGooglePlay\Api;

use Doctrine\Common\Collections\ArrayCollection;
use Scraper\ScraperGooglePlay\Entity\GooglePlayReview;
use Scraper\ScraperGooglePlay\Request\GooglePlayReviewRequest;
use Scraper\ScraperGooglePlay\Utils\Tools;
use Symfony\Component\DomCrawler\Crawler;

class GooglePlayReviewApi extends GooglePlayApi
{
	/**
	 * @var GooglePlayReviewRequest
	 */
	protected $request;

	/**
	 * @return ArrayCollection|mixed
	 */
	public function execute(){
		$data = new Crawler();
		$data->addHtmlContent($this->data[0][2]);

		$this->object = new ArrayCollection();

		$data->filter('.single-review')->each(function(Crawler $node, $i){

			$picture = $node->filter('.responsive-img-ldpi .author-image')->attr('style');
			$picture = str_replace(['background-image:url(', 'w48-h48-p/', ')'], '', $picture);

			$note = $node->filter('.current-rating')->attr('style');
			$note = str_replace(['width: ', '%;'], '', $note);
			if(is_numeric($note)){
				$note = 5*$note/100;
			}else{
				$note = 0;
			}


			$reviewText = $node->filter('.review-body')->html();
			$reviewText = preg_replace('#<div(.+)</div>#', '', $reviewText);
			$reviewText = trim(strip_tags($reviewText));

			$date = $node->filter('.review-date')->text();
			$date = Tools::frenchDateToEnglish($date);

			$review = new GooglePlayReview();
			$review
				->setName(trim($node->filter('.author-name')->text()))
				->setDateTime(\DateTime::createFromFormat("j F Y", $date))
				->setPicture($picture)
				->setLink($this->urlAnnotation->baseUrl.$node->filter('.reviews-permalink')->attr('href'))
				->setReview($reviewText)
				->setNote($note)
			;

			$this->object->add($review);
		});
		return $this->object;
	}
}
