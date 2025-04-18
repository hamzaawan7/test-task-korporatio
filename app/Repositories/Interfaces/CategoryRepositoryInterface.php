<?php

namespace App\Repositories\Interfaces;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function getParentCategories();
    public function getChildCategories($parentId);
    public function getCategoryTree();
    public function getProductsByCategory($categoryId);
}
