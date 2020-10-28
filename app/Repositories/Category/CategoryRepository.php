<?php

namespace App\Repositories\Category;

use App\Models\Category;

/**
 * Class CategoryRepository
 *
 * @package App\Repositories\Category
 */
class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category) {
        $this->category = $category;
    }

    /**
     * 1件取得する
     *
     * @param int $id
     */
    public function getOne(int $id)
    {
        return $this->category->find($id);
    }
}
