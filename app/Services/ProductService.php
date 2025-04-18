<?php

namespace App\Services;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function all()
    {
        return $this->productRepository->all();
    }

    public function find($id)
    {
        return $this->productRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->productRepository->delete($id);
    }

    public function getFeaturedProducts($limit = 5)
    {
        return $this->productRepository->getFeaturedProducts($limit);
    }

    public function getProductsByCategory($categoryId)
    {
        return $this->productRepository->getProductsByCategory($categoryId);
    }

    public function searchProducts($query)
    {
        return $this->productRepository->searchProducts($query);
    }

    public function getProductsWithFilters($filters)
    {
        return $this->productRepository->getProductsWithFilters($filters);
    }

    public function findBySlug(string $slug)
    {
        return $this->productRepository->findBySlug($slug);
    }

    public function getRelatedProducts(Product $product, int $limit = 4)
    {
        return $this->productRepository->getRelatedProducts($product, $limit);
    }
}
