<?php

namespace App\Repositories;

use App\Models\Category;
use App\Repositories\EloquentRepository;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryRepository extends EloquentRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function getParentCategories()
    {
        return $this->model->whereNull('parent_id')->with('children')->get();
    }

    public function getChildCategories($parentId)
    {
        return $this->model->where('parent_id', $parentId)->get();
    }

    public function getCategoryTree()
    {
        return $this->model->with('children')->whereNull('parent_id')->get();
    }

    public function getProductsByCategory($categoryId)
    {
        return $this->model->findOrFail($categoryId)
            ->products()
            ->where('is_active', true)
            ->paginate(12);
    }
}
