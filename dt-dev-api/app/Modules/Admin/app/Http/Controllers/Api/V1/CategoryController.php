<?php

namespace Modules\Admin\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Modules\Admin\App\Services\CategoryService;
use Modules\Admin\App\Http\Resources\Category\CategoryCollection;

class CategoryController extends BaseController
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService) {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        return new CategoryCollection(
            $this->categoryService->getCategories($request->all()),
            __FUNCTION__
        );
    }
}
