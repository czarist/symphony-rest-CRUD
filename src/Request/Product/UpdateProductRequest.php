<?php

namespace App\Request\Product;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateProductRequest extends CreateProductRequest
{
    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $id;
}
