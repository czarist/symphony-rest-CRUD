<?php

namespace App\Controller;

use App\Request\Product\CreateProductRequest;
use App\Request\Product\UpdateProductRequest;
use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

#[Route('/products')]
class ProductController extends AbstractController
{
    public function __construct(private ProductService $service) {}

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $productRequest = new CreateProductRequest();
        $productRequest->name = $data['name'];
        $productRequest->price = $data['price'];
        $productRequest->status = $data['status'];
        $productRequest->categoryId = $data['category_id'];

        $product = $this->service->create($productRequest);
        return $this->json($product);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $productRequest = new UpdateProductRequest();
        $productRequest->id = $id;
        $productRequest->name = $data['name'];
        $productRequest->price = $data['price'];
        $productRequest->status = $data['status'];

        $product = $this->service->update($productRequest);
        return $this->json($product);
    }
}
