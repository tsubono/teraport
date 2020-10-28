<?php

namespace App\Repositories\Category;

use App\Models\Category;

interface CategoryRepositoryInterface
{
    public function getOne(int $id);
}
