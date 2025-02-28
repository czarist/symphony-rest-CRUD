<?php
namespace App\Service;

use App\Entity\Product;
use App\Enum\ProductStatus;
use App\Repository\ProductCategoryRepository;
use App\Repository\ProductRepository;
use App\Request\Product\CreateProductRequest;
use App\Request\Product\UpdateProductRequest;
use Doctrine\ORM\EntityManagerInterface;

class ProductService
{
    public function __construct(
        private ProductRepository $repository,
        private ProductCategoryRepository $categoryRepository,
        private EntityManagerInterface $em
    ) {}

    public function create(CreateProductRequest $request): Product
    {
        $category = $this->categoryRepository->find($request->categoryId);
        if (! $category) {
            throw new \Exception("Category not found");
        }

        $product = new Product();
        $product->setName($request->name);
        $product->setPrice($request->price);
        $product->setStatus(ProductStatus::tryFrom($request->status) ?? ProductStatus::AVAILABLE);
        $product->setCategory($category);

        $this->em->persist($product);
        $this->em->flush();

        return $product;
    }

    public function update(UpdateProductRequest $request): Product
    {
        $product = $this->repository->find($request->id);
        if (! $product) {
            throw new \Exception("Product not found");
        }

        $product->setName($request->name);
        $product->setPrice($request->price);
        $product->setStatus(ProductStatus::tryFrom($request->status) ?? ProductStatus::AVAILABLE);

        $this->em->flush();

        return $product;
    }
}
