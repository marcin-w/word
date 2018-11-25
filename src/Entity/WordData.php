<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WordDataRepository")
 */
class WordData
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $word_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $language_id;

    /**
     * @ORM\Column(type="string", length=50000)
     */
    private $data;

    /**
     * @ORM\Column(type="smallint")
     */
    private $item_status;

    /**
     * @ORM\Column(type="datetime")
     */
    private $item_timestamp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWordId(): ?int
    {
        return $this->word_id;
    }

    public function setWordId(int $word_id): self
    {
        $this->word_id = $word_id;

        return $this;
    }

    public function getLanguageId(): ?int
    {
        return $this->language_id;
    }

    public function setLanguageId(int $language_id): self
    {
        $this->language_id = $language_id;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getItemStatus(): ?int
    {
        return $this->item_status;
    }

    public function setItemStatus(int $item_status): self
    {
        $this->item_status = $item_status;

        return $this;
    }

    public function getItemTimestamp(): ?\DateTimeInterface
    {
        return $this->item_timestamp;
    }

    public function setItemTimestamp(\DateTimeInterface $item_timestamp): self
    {
        $this->item_timestamp = $item_timestamp;

        return $this;
    }
}
