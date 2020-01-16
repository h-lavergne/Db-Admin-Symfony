<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FoodRepository")
 * @Vich\Uploadable
 */
class Food
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min=3, max=15)
     */
    private $name;

    /**
     * @ORM\Column(type="float")
     * @Assert\Range(min=0.1, max=100)
     */
    private $price;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="food_image", fileNameProperty="image")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="integer")
     */
    private $calorie;

    /**
     * @ORM\Column(type="float")
     */
    private $protein;

    /**
     * @ORM\Column(type="float")
     */
    private $carbohydrate;

    /**
     * @ORM\Column(type="float")
     */
    private $lipid;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

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

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCalorie(): ?int
    {
        return $this->calorie;
    }

    public function setCalorie(int $calorie): self
    {
        $this->calorie = $calorie;

        return $this;
    }

    public function getProtein(): ?float
    {
        return $this->protein;
    }

    public function setProtein(float $protein): self
    {
        $this->protein = $protein;

        return $this;
    }

    public function getCarbohydrate(): ?float
    {
        return $this->carbohydrate;
    }

    public function setCarbohydrate(float $carbohydrate): self
    {
        $this->carbohydrate = $carbohydrate;

        return $this;
    }

    public function getLipid(): ?float
    {
        return $this->lipid;
    }

    public function setLipid(float $lipid): self
    {
        $this->lipid = $lipid;

        return $this;
    }

    public function getImageFile(): ?File{
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): self {
        $this->imageFile = $imageFile;


        if ($this->imageFile instanceof UploadedFile){
            $this->updated_at = new \DateTimeImmutable('now');
        }

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
