<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubOfSubCategory;

class CategoriesController extends Controller
{
        // Returns Categories Page
        public function categories()
        {
            $categories = Category::all();
    
            return view('admin.categories.mainCats' , compact('categories'));
        }
    
        // Add Category
        public function addCategory()
        {
            $validator = Validator::make(request()->all(), [
                'name' => 'required',
                'image' => 'nullable|file|mimes:jpg,png,jpeg|max:2048',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.categories')->with('error', $validator->errors()->first());
            }
            $category = new Category();
            $category->name = request()->name;
            if (request()->hasFile('image')) {
                $image = request()->file('image')->store('categories_images');
                $category->image = $image;
            }
            $category->save();
            return redirect()->route('admin.categories')->with('success', 'Category Added Successfully');
        }
    
        // Delete Category
        public function deleteCategory($id) {
            $category = Category::find($id);
            $category->delete();
            return redirect()->route('admin.categories')->with('success', 'Category Deleted Successfully');
        }

        //=======================================================================
    
        // Return SubCategories Page
        public function subCategories()
        {
            // Retrieve all categories
            $categories = Category::all();
        
            // Retrieve all subcategories with their associated category
            $subCategories = SubCategory::with('category')->get();
        
            return view('admin.categories.subCats', compact('categories', 'subCategories'));
        }
        
    
        // Add SubCategory
        public function addSubCategory()
        {
            $validator = Validator::make(request()->all(), [
                'name' => 'required',
                'category_id' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('admin.subCategories')->with('error', $validator->errors()->first());
            }
            $subCategory = new SubCategory();
            $subCategory->name = request()->name;
            $subCategory->category_id = request()->category_id;
            $subCategory->save();
            return redirect()->route('admin.subCategories')->with('success', 'SubCategory Added Successfully');
        }
    
        // Delete SubCategory
        public function deleteSubCategory($id) {
            $subCategory = SubCategory::find($id);
            $subCategory->delete();
            return redirect()->route('admin.subCategories')->with('success', 'SubCategory Deleted Successfully');
        }
        // Returns Sub Of Sub Categories Page
        public function subOfSubCategories()
    {
        // Retrieve all categories
        $categories = Category::all();
    
        // Retrieve all subcategories
        $subCategories = SubCategory::all();
    
        // Retrieve all sub-subcategories with their associated subcategory and category
        $subOfSubCategories = SubOfSubCategory::with(['subCategory.category'])->get();
    
        return view('admin.categories.subOfSubCats', compact('categories', 'subOfSubCategories'));
    }
    
        // Add Sub Of Sub Category
        public function addSubOfSubCategory()
    {
        // Validate the request data
        $validator = Validator::make(request()->all(), [
            'name' => 'required|string|max:255',
            'category_id' => 'required',
            'sub_category_id' => 'required',
        ]);
    
        // If validation fails, redirect with an error message
        if ($validator->fails()) {
            return redirect()->back()->with('error', $validator->errors()->first());
        }
    
        // Create new SubOfSubCategory
        $subOfSubCategory = new SubOfSubCategory();
        $subOfSubCategory->name = request()->name;
        $subOfSubCategory->sub_category_id = request()->sub_category_id;
        $subOfSubCategory->category_id = request()->category_id;
        $subOfSubCategory->save();
    
        // Redirect to the correct route with success message
        return redirect()->route('admin.subOfSubCategories')->with('success', 'Sub Of Subcategory Added Successfully');
    }
    
        // Delete Sub Of Sub Category
        public function deleteSubOfSubCategory($id) {
            $subOfSubCategory = SubOfSubCategory::find($id);
            $subOfSubCategory->delete();
            return redirect()->route('admin.subOfSubCategories')->with('success', 'Sub Of Subcategory Deleted Successfully');
        }
    
    public function getSubCategories($categoryId)
    {
        // Get the subcategories related to the selected category
        $subCategories = SubCategory::where('category_id', $categoryId)->get();
        
        // Return the subcategories as a JSON response
        return response()->json($subCategories);
    }
}
