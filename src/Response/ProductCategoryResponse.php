<?php
namespace App\Response;

use App\Entity\ProductCategory;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductCategoryResponse
{
   
    public static function single(ProductCategory $category, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse([
            'id'   => $category->getId(),
            'name' => $category->getName(),
        ], $statusCode);
    }

    public static function collection(array $categories): JsonResponse
    {
        return new JsonResponse(
            array_map(fn(ProductCategory $category) => [
                'id'   => $category->getId(),
                'name' => $category->getName(),
            ], $categories),
            200
        );
    }

    
    public static function success(string $message, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse(['message' => $message], $statusCode);
    }

    
    public static function error(string $message, int $statusCode = 400): JsonResponse
    {
        return new JsonResponse(['error' => $message], $statusCode);
    }
}
