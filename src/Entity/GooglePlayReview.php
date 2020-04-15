<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayReview
 */
class GooglePlayReview
{
    protected $idReview;
    /** @var string */
    protected $idUser;
    /** @var string */
    protected $name;
    /** @var string */
    protected $picture;
    /** @var string */
    protected $surname;
    /** @var \DateTime|string */
    protected $dateTime;
    /** @var string */
    protected $link;
    /** @var string */
    protected $review;
    /** @var int */
    protected $note;
    /** @var string */
    protected $noteText;

    public function getIdReview()
    {
        return $this->idReview;
    }

    /**
     * @return $this
     */
    public function setIdReview($idReview)
    {
        $this->idReview = $idReview;
        return $this;
    }

    /**
     * @return string
     */
    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    /**
     * @param string $idUser
     *
     * @return $this
     */
    public function setIdUser(?string $idUser)
    {
        $this->idUser = $idUser;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(?string $name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     *
     * @return $this
     */
    public function setPicture(?string $picture)
    {
        $this->picture = $picture;
        return $this;
    }

    /**
     * @return string
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return $this
     */
    public function setSurname(?string $surname)
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return \DateTime|string
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTime|string $dateTime
     *
     * @return $this
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    /**
     * @return string
     */
    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @return $this
     */
    public function setLink(?string $link)
    {
        $this->link = $link;
        return $this;
    }

    /**
     * @return string
     */
    public function getReview(): ?string
    {
        return $this->review;
    }

    /**
     * @param string $review
     *
     * @return $this
     */
    public function setReview(?string $review)
    {
        $this->review = $review;
        return $this;
    }

    /**
     * @return int
     */
    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * @param int $note
     *
     * @return $this
     */
    public function setNote(?int $note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return string
     */
    public function getNoteText(): ?string
    {
        return $this->noteText;
    }

    /**
     * @param string $noteText
     *
     * @return $this
     */
    public function setNoteText(?string $noteText)
    {
        $this->noteText = $noteText;
        return $this;
    }
}
