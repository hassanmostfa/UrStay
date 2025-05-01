<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubOfSubCategory;

class CategoriesController extends Controller
{
    // Get all categories
    public function getCategories()
    {
        $categories = Category::all();

        return response()->json([
            'status' => true,
            'msg' => 'Categories retrieved successfully',
            'data' => $categories,
            'notes' => ['List of all categories retrieved'],
        ], 200);
    }

    // Add a new category
    public function addCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => 'Validation error',
                'data' => null,
                'notes' => [$validator->errors()->first()],
            ], 422);
        }

        $category = new Category();
        $category->name = $request->name;
        if ($request->hasFile('image')) {
            $image = $request->file('image')->store('categories_images');
            $category->image = $image;
        }
        $category->save();

        return response()->json([
            'status' => true,
            'msg' => 'Category added successfully',
            'data' => $category,
            'notes' => ['Category created successfully'],
        ], 201);
    }

    // Delete a category
    public function deleteCategory($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'msg' => 'Category not found',
                'data' => null,
                'notes' => ['Category with the given ID does not exist'],
            ], 404);
        }

        $category->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Category deleted successfully',
            'data' => null,
            'notes' => ['Category deletion successful'],
        ], 200);
    }

    // Get all subcategories for a category
    public function getSubCategories($categoryId)
    {
        $subCategories = SubCategory::where('category_id', $categoryId)->get();

        return response()->json([
            'status' => true,
            'msg' => 'Subcategories retrieved successfully',
            'data' => $subCategories,
            'notes' => ['List of subcategories for the given category'],
        ], 200);
    }

    // Add a new subcategory
    public function addSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => 'Validation error',
                'data' => null,
                'notes' => [$validator->errors()->first()],
            ], 422);
        }

        $subCategory = new SubCategory();
        $subCategory->name = $request->name;
        $subCategory->category_id = $request->category_id;
        $subCategory->save();

        return response()->json([
            'status' => true,
            'msg' => 'Subcategory added successfully',
            'data' => $subCategory,
            'notes' => ['Subcategory created successfully'],
        ], 201);
    }

    // Delete a subcategory
    public function deleteSubCategory($id)
    {
        $subCategory = SubCategory::find($id);

        if (!$subCategory) {
            return response()->json([
                'status' => false,
                'msg' => 'Subcategory not found',
                'data' => null,
                'notes' => ['Subcategory with the given ID does not exist'],
            ], 404);
        }

        $subCategory->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Subcategory deleted successfully',
            'data' => null,
            'notes' => ['Subcategory deletion successful'],
        ], 200);
    }

    // Get all sub-subcategories
    public function getSubOfSubCategories()
    {
        $subOfSubCategories = SubOfSubCategory::with(['subCategory.category'])->get();

        return response()->json([
            'status' => true,
            'msg' => 'Sub of subcategories retrieved successfully',
            'data' => $subOfSubCategories,
            'notes' => ['List of all sub of subcategories retrieved'],
        ], 200);
    }

    // Add a new sub of subcategory
    public function addSubOfSubCategory(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => 'Validation error',
                'data' => null,
                'notes' => [$validator->errors()->first()],
            ], 422);
        }

        $subOfSubCategory = new SubOfSubCategory();
        $subOfSubCategory->name = $request->name;
        $subOfSubCategory->sub_category_id = $request->sub_category_id;
        $subOfSubCategory->category_id = $request->category_id;
        $subOfSubCategory->save();

        return response()->json([
            'status' => true,
            'msg' => 'Sub of subcategory added successfully',
            'data' => $subOfSubCategory,
            'notes' => ['Sub of subcategory created successfully'],
        ], 201);
    }

    // Delete a sub of subcategory
    public function deleteSubOfSubCategory($id)
    {
        $subOfSubCategory = SubOfSubCategory::find($id);

        if (!$subOfSubCategory) {
            return response()->json([
                'status' => false,
                'msg' => 'Sub of subcategory not found',
                'data' => null,
                'notes' => ['Sub of subcategory with the given ID does not exist'],
            ], 404);
        }

        $subOfSubCategory->delete();

        return response()->json([
            'status' => true,
            'msg' => 'Sub of subcategory deleted successfully',
            'data' => null,
            'notes' => ['Sub of subcategory deletion successful'],
        ], 200);
    }
}
