<?php
namespace App\Controller;

use App\Entity\Product;
use App\Request\Product\CreateProductRequest;
use App\Request\Product\UpdateProductRequest;
use App\Response\ProductResponse;
use App\Service\ProductService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/products')]
class ProductController extends AbstractController
{
    public function __construct(
        private ProductService $service,
        private EntityManagerInterface $em
    ) {}

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data                       = json_decode($request->getContent(), true);
        $productRequest             = new CreateProductRequest();
        $productRequest->name       = $data['name'];
        $productRequest->price      = $data['price'];
        $productRequest->status     = $data['status'];
        $productRequest->categoryId = $data['category_id'];

        $product = $this->service->create($productRequest);

        return ProductResponse::single($product, 201);
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(int $id, Request $request): JsonResponse
    {
        $data                   = json_decode($request->getContent(), true);
        $productRequest         = new UpdateProductRequest();
        $productRequest->id     = $id;
        $productRequest->name   = $data['name'];
        $productRequest->price  = $data['price'];
        $productRequest->status = $data['status'];

        $product = $this->service->update($productRequest);

        return ProductResponse::single($product);
    }

    #[Route('', methods: ['GET'])]
    public function getAllProducts(): JsonResponse
    {
        $products = $this->em->getRepository(Product::class)->findAll();

        return ProductResponse::collection($products);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function getProductById(int $id): JsonResponse
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        if (! $product) {
            return ProductResponse::error('Product not found', 404);
        }

        return ProductResponse::single($product);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $product = $this->em->getRepository(Product::class)->find($id);
        if (! $product) {
            return ProductResponse::error('Product not found', 404);
        }

        $this->em->remove($product);
        $this->em->flush();

        return ProductResponse::success('Product deleted');
    }
}
