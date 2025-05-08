<?php

namespace Modules\Admin\App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\BaseController;
use App\Models\Category;
use App\Modules\Admin\Http\Requests\Category\UpdateStatusRequest;
use Illuminate\Http\Request;
use Modules\Admin\App\Http\Resources\Category\CategoryCollection;
use Modules\Admin\App\Services\CategoryService;

class CategoryController extends BaseController
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index(Request $request)
    {
        return new CategoryCollection(
            $this->categoryService->getCategories($request->all()),
            __FUNCTION__
        );
    }

    public function updateStatus(Category $category, UpdateStatusRequest $request)
    {
        $this->authorize('updateStatus', $category);

        $this->categoryService->update($category, [
            'status' => $request->status,
        ]);

        return $this->responseJsonSuccess([]);
    }
}
