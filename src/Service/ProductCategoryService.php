<?php

namespace App\Service;

use App\Entity\ProductCategory;
use App\Repository\ProductCategoryRepository;
use App\Request\Category\CreateCategoryRequest;
use App\Request\Category\UpdateCategoryRequest;
use Doctrine\ORM\EntityManagerInterface;

class ProductCategoryService
{
    public function __construct(
        private ProductCategoryRepository $repository,
        private EntityManagerInterface $em
    ) {}

    public function create(CreateCategoryRequest $request): ProductCategory
    {
        $category = new ProductCategory();
        $category->setName($request->name);

        $this->em->persist($category);
        $this->em->flush();

        return $category;
    }

    public function update(UpdateCategoryRequest $request, ProductCategory $category): ProductCategory
    {
        $category->setName($request->name);
        $this->em->flush();

        return $category;
    }

    public function delete(ProductCategory $category): void
    {
        $this->em->remove($category);
        $this->em->flush();
    }
}
