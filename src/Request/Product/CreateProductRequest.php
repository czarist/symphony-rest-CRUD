<?php

namespace App\Request\Product;

use Symfony\Component\Validator\Constraints as Assert;

class CreateProductRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $name;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public float $price;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [\App\Enum\ProductStatus::class, 'cases'])]
    public string $status;

    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $categoryId;
}
