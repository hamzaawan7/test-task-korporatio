<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all()
    {
        return $this->categoryRepository->all();
    }

    public function find($id)
    {
        return $this->categoryRepository->find($id);
    }

    public function create(array $data)
    {
        return $this->categoryRepository->create($data);
    }

    public function update($id, array $data)
    {
        return $this->categoryRepository->update($id, $data);
    }

    public function delete($id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function getParentCategories()
    {
        return $this->categoryRepository->getParentCategories();
    }

    public function getChildCategories($parentId)
    {
        return $this->categoryRepository->getChildCategories($parentId);
    }

    public function getCategoryTree()
    {
        return $this->categoryRepository->getCategoryTree();
    }

    public function getProductsByCategory($categoryId)
    {
        return $this->categoryRepository->getProductsByCategory($categoryId);
    }
}
