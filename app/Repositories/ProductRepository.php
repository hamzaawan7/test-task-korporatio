<?php

namespace App\Repositories;

use App\Models\Product;
use App\Repositories\Interfaces\ProductRepositoryInterface;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{
    public function __construct(Product $model)
    {
        parent::__construct($model);
    }

    public function getFeaturedProducts($limit = 5)
    {
        return $this->model->where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get();
    }

    public function getProductsByCategory($categoryId)
    {
        return $this->model->whereHas('categories', function($query) use ($categoryId) {
            $query->where('categories.id', $categoryId);
        })->where('is_active', true)->get();
    }

    public function searchProducts($query)
    {
        return $this->model->where('name', 'like', "%{$query}%")
            ->orWhere('description', 'like', "%{$query}%")
            ->where('is_active', true)
            ->get();
    }

    public function getProductsWithFilters($filters)
    {
        $query = $this->model->where('is_active', true);

        if (!empty($filters['category'])) {
            $selectedCategoryId = $filters['category'];
            $query->whereHas('categories', function($q) use ($selectedCategoryId) {
                $q->where(function($query) use ($selectedCategoryId) {
                    $query->where('categories.id', $selectedCategoryId)
                        ->orWhere('categories.parent_id', $selectedCategoryId);
                });
            });
        }

        if (!empty($filters['search'])) {
            $query->where(function($q) use ($filters) {
                $q->where('name', 'like', "%{$filters['search']}%")
                    ->orWhere('description', 'like', "%{$filters['search']}%");
            });
        }

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }

        return $query->paginate(12);
    }

    public function findBySlug(string $slug)
    {
        return $this->model->where('slug', $slug)
            ->with('categories')
            ->firstOrFail();
    }

    public function getRelatedProducts(Product $product, int $limit = 4)
    {
        return $this->model->whereHas('categories', function($query) use ($product) {
            $query->whereIn('categories.id', $product->categories->pluck('id'));
        })
            ->where('id', '!=', $product->id)
            ->limit($limit)
            ->get();
    }
}
