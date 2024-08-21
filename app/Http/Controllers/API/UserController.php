<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class UserController extends Controller
{

    /*Retrieves all users from the database and returns them as a JSON response.*/
    public function showAllUsers()
    {
        $users = User::all();
        return response()->json($users);
    }


    /*Retrieves a single user from the database and returns it as a JSON response.*/
    public function showOneUser($id)
    {
        $user = User::findorfail($id);
        return response()->json($user);
    }


    /*Updates a user in the database and returns the updated user as a JSON response.*/
    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);
        if ($user) {
            try {
                $validator = Validator::make($request->all(), [
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
                    'password' => 'required',
                    'role' => 'required',
                ]);
                if ($validator->fails()) {
                    return response()->json($validator->errors(), 400);
                }else {
                    $user->update([
                        'name' => $request->name,
                        'email' => $request->email,
                        'role' => $request->role,
                        'password' => Hash::make($request->password),
                    ]);
                    return response()->json(["success" => true, "message" => "User updated successfully." , "data" => $user ,], 200);
                }
            } catch (\Throwable $th) {
                return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
            }
        }else {
            return response()->json(['success' => false, 'message' => 'User not found.'], 404);
        }
    }


    /*Deletes a user from the database and returns the deleted user as a JSON response.*/
    public function destroy($id)
    {
        try {
            $user = User::findorfail($id);
            if ($user) {
                $user->delete();
                return response()->json(["success" => true, "message" => "User deleted successfully."], 200);
            }else {
                return response()->json(['success' => false, 'message' => 'User not found.'], 404);
            }
        } catch (\Throwable $th) {
            return response()->json(['success' => false, 'message' => $th->getMessage()], 500);
        }
    }
}
