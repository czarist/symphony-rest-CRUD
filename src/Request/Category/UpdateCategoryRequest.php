<?php

namespace App\Request\Category;

use Symfony\Component\Validator\Constraints as Assert;

class UpdateCategoryRequest extends CreateCategoryRequest
{
    #[Assert\NotBlank]
    #[Assert\Positive]
    public int $id;
}
