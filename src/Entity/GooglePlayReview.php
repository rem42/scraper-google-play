<?php

namespace Scraper\ScraperGooglePlay\Entity;

/**
 * Class GooglePlayReview
 */
final class GooglePlayReview
{
    protected $idReview;
    protected ?string $idUser;
    protected ?string $name;
    protected ?string $picture;
    protected ?string $surname;
    /** @var \DateTime|string */
    protected $dateTime;
    protected ?string $link;
    protected ?string $review;
    protected ?int $note;
    protected ?string $noteText;

    public function getIdReview()
    {
        return $this->idReview;
    }

    /**
     * @return $this
     */
    public function setIdReview($idReview): self
    {
        $this->idReview = $idReview;
        return $this;
    }

    public function getIdUser(): ?string
    {
        return $this->idUser;
    }

    /**
     * @param string $idUser
     *
     * @return $this
     */
    public function setIdUser(?string $idUser): self
    {
        $this->idUser = $idUser;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return $this
     */
    public function setName(?string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    /**
     * @param string $picture
     *
     * @return $this
     */
    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;
        return $this;
    }

    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     *
     * @return $this
     */
    public function setSurname(?string $surname): self
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
    public function setDateTime($dateTime): self
    {
        $this->dateTime = $dateTime;
        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    /**
     * @param string $link
     *
     * @return $this
     */
    public function setLink(?string $link): self
    {
        $this->link = $link;
        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    /**
     * @param string $review
     *
     * @return $this
     */
    public function setReview(?string $review): self
    {
        $this->review = $review;
        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    /**
     * @param int $note
     *
     * @return $this
     */
    public function setNote(?int $note): self
    {
        $this->note = $note;
        return $this;
    }

    public function getNoteText(): ?string
    {
        return $this->noteText;
    }

    /**
     * @param string $noteText
     *
     * @return $this
     */
    public function setNoteText(?string $noteText): self
    {
        $this->noteText = $noteText;
        return $this;
    }
}
