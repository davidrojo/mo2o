<?php

namespace App\Entity;

use JMS\Serializer\Annotation\Groups;

class Beer
{
    /**
     * @var int
     * @Groups({"list", "details"})
     */
    private $id;

    /**
     * @var string
     * @Groups({"list", "details"})
     */
    private $name;

    /**
     * @var string
     * @Groups({"list", "details"})
     */
    private $description;

    /**
     * @var string
     * @Groups({"details"})
     */
    private $imageUrl;

    /**
     * @var string
     * @Groups({"details"})
     */
    private $tagline;

    /**
     * @var string
     * @Groups({"details"})
     */
    private $firstBrewed;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function getImageUrl(): string
    {
        return $this->imageUrl;
    }

    public function setImageUrl(string $imageUrl): self
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    public function getTagline(): string
    {
        return $this->tagline;
    }

    public function setTagline(string $tagline): self
    {
        $this->tagline = $tagline;
        return $this;
    }

    public function getFirstBrewed(): string
    {
        return $this->firstBrewed;
    }

    public function setFirstBrewed(string $firstBrewed): self
    {
        $this->firstBrewed = $firstBrewed;
        return $this;
    }
}