<?php
namespace App\Controller;

use App\Entity\ProductCategory;
use App\Request\Category\CreateCategoryRequest;
use App\Request\Category\UpdateCategoryRequest;
use App\Response\ProductCategoryResponse;
use App\Service\ProductCategoryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/categories')]
class ProductCategoryController extends AbstractController
{
    public function __construct(
        private ProductCategoryService $service,
        private EntityManagerInterface $em
    ) {}

    #[Route('', methods: ['POST'])]
    public function create(Request $request)
    {
        $data                  = json_decode($request->getContent(), true);
        $categoryRequest       = new CreateCategoryRequest();
        $categoryRequest->name = $data['name'];

        $category = $this->service->create($categoryRequest);

        return ProductCategoryResponse::single($category, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request)
    {
        $category = $this->em->getRepository(ProductCategory::class)->find($id);
        if (! $category) {
            return ProductCategoryResponse::error('Category not found', 404);
        }

        $data                  = json_decode($request->getContent(), true);
        $categoryRequest       = new UpdateCategoryRequest();
        $categoryRequest->id   = $id;
        $categoryRequest->name = $data['name'];

        $updatedCategory = $this->service->update($categoryRequest, $category);

        return ProductCategoryResponse::single($updatedCategory);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id)
    {
        $category = $this->em->getRepository(ProductCategory::class)->find($id);
        if (! $category) {
            return ProductCategoryResponse::error('Category not found', 404);
        }

        $this->service->delete($category);

        return ProductCategoryResponse::success('Category deleted');
    }

    #[Route('', methods: ['GET'])]
    public function getAllCategories()
    {
        $categories = $this->em->getRepository(ProductCategory::class)->findAll();

        return ProductCategoryResponse::collection($categories);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getCategoryById(int $id)
    {
        $category = $this->em->getRepository(ProductCategory::class)->find($id);
        if (! $category) {
            return ProductCategoryResponse::error('Category not found', 404);
        }

        return ProductCategoryResponse::single($category);
    }
}
