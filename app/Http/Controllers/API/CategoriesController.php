<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{

    /*Retrieves all categories from the database and returns them as a JSON response.*/
    public function showAllCategories()
    {
        $categories = Category::all();
        return response()->json(["success" => true ,"data" => $categories], 200);
    }



    /*Creates a new category in the database and returns the created category as a JSON response.*/
    public function createCategory(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
            ]);
            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }else {
                $category = Category::create([
                    'name' => $request->name,
                    'description' => $request->description,
                    'slug' => $request->slug,
                    'status' => $request->status,
                ]);
                return response()->json(["success" => true ,"data" => $category], 200);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }



    /*Retrieves a single category from the database and returns it as a JSON response.*/
    public function showOneCategory($id)
    {
        $category = Category::findorfail($id);
        return response()->json(["success" => true ,"data" => $category], 200);
    } 



    /*Updates a category in the database and returns the updated category as a JSON response.*/
    public function updateCategory(Request $request, $id)
    {
        $category = Category::findorfail($id);
        if ($category) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }else {
                    $category->update([
                        'name' => $request->name,
                        'description' => $request->description,
                        'slug' => $request->slug,
                        'status' => $request->status,
                    ]);
                    return response()->json(["success" => true , "message" => "Category updated successfully." ,"data" => $category], 200);
                }
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            }
        }else {
            return response()->json(['success' => false, 'message' => 'Category not found.'], 404);
        }
    }



    /*Deletes a category from the database and returns the deleted category as a JSON response.*/
    public function destroyCategory($id)
    {
        try {
            $category = Category::findorfail($id);
            if ($category) {
                $category->delete();
                return response()->json(["success" => true, "message" => "Category deleted successfully."], 200);
            }else {
                return response()->json(['success' => false, 'message' => 'Category not found.'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
