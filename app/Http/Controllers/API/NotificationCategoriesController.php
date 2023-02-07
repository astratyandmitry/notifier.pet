<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\NotificationCategory;
use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationCategoryResource;
use App\Http\Requests\API\NotificationCategoryRequest;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NotificationCategoriesController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $categories = NotificationCategory::query()->latest()->get();

        return NotificationCategoryResource::collection($categories);
    }

    public function store(NotificationCategoryRequest $request): JsonResponse
    {
        $category = NotificationCategory::query()->create($request->validated());

        return response()->json([
            'message' => 'Category created successfully',
            'data' => new NotificationCategoryResource($category),
        ], 201);
    }

    public function show(int $id): NotificationCategoryResource
    {
        $category = NotificationCategory::query()->findOrFail($id);

        return new NotificationCategoryResource($category);
    }

    public function update(NotificationCategoryRequest $request, int $id): JsonResponse
    {
        $category = NotificationCategory::query()->findOrFail($id);
        $category->update($request->validated());

        return response()->json([
            'message' => 'Category updated successfully',
            'data' => new NotificationCategoryResource($category),
        ], 200);
    }

    public function destroy(int $id): JsonResponse
    {
        $category = NotificationCategory::query()->findOrFail($id);
        $category->delete();

        return response()->json([
            'message' => 'Category deleted successfully',
        ], 200);
    }
}
