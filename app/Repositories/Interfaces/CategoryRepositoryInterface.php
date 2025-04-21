<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getParentCategories();
    public function getChildCategories($parentId);
    public function getCategoryTree();
    public function getProductsByCategory($categoryId);
}
