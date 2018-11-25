<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\WordRepository")
 */
class Word
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="smallint", options={"default" : 1})
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

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
