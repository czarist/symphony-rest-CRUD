<?php
namespace App\Entity;

use App\Enum\ProductStatus;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $name;

    #[ORM\Column(type: "decimal", scale: 2)]
    private float $price;

    #[ORM\Column(type: "string", length: 20)]
    private string $status;

    #[ORM\ManyToOne(targetEntity: ProductCategory::class)]
    #[ORM\JoinColumn(name: "category_id", referencedColumnName: "id", nullable: true, onDelete: "SET NULL")]
    private ?ProductCategory $category = null;

    public function getId(): ?int
    {return $this->id;}

    public function getName(): string
    {return $this->name;}

    public function setName(string $name): void
    {$this->name = $name;}

    public function getPrice(): float
    {return $this->price;}

    public function setPrice(float $price): void
    {$this->price = $price;}

    public function getStatus(): ProductStatus
    {
        return ProductStatus::from($this->status);
    }

    public function setStatus(ProductStatus $status): void
    {
        $this->status = $status->value;
    }

    public function getCategory(): ?ProductCategory
    {return $this->category;}

    public function setCategory(?ProductCategory $category): void
    {$this->category = $category;}
}
