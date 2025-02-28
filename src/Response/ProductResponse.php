<?php
namespace App\Response;

use App\Entity\Product;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductResponse
{
    public static function single(Product $product, int $statusCode = 200): JsonResponse
    {
        return new JsonResponse([
            'id'       => $product->getId(),
            'name'     => $product->getName(),
            'price'    => number_format($product->getPrice(), 2, ',', '.'),
            'status'   => $product->getStatus()->value,
            'category' => [
                'id'   => $product->getCategory()?->getId(),
                'name' => $product->getCategory()?->getName(),
            ],
        ], $statusCode);
    }

    public static function collection(array $products): JsonResponse
    {
        return new JsonResponse(
            array_map(fn(Product $product) => [
                'id'       => $product->getId(),
                'name'     => $product->getName(),
                'price'    => number_format($product->getPrice(), 2, ',', '.'),
                'status'   => $product->getStatus()->value,
                'category' => [
                    'id'   => $product->getCategory()?->getId(),
                    'name' => $product->getCategory()?->getName(),
                ],
            ], $products),
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
