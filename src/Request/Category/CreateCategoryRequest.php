<?php

namespace App\Request\Category;

use Symfony\Component\Validator\Constraints as Assert;

class CreateCategoryRequest
{
    #[Assert\NotBlank]
    #[Assert\Length(min: 3, max: 255)]
    public string $name;
}
