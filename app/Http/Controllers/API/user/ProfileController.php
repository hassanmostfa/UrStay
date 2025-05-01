<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileController extends Controller
{
    // get user Data
    public function getUserData(){
        try{
            $user = Auth::user();
            return response()->json(['status' => 'success', 'data' => $user], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
        }
    }

    /****************************************************************************************/
    public function updateUserData(Request $request)
    {
        try {
            $user = Auth::user();
    
            // Validate input data
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255',
                'phone' => 'required|exists:users',
                'role' => 'required|string',
                'personal_id' => 'nullable|string|max:50',
                'birth_date' => 'nullable|date',
                'passport_number' => 'nullable|string|max:50',
                'nationality' => 'nullable|string|max:100',
                'residence_number' => 'nullable|string|max:50',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()], 422);
            }
    
            // Update user data
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role' => $request->role,
                'personal_id' => $request->personal_id,
                'birth_date' => $request->birth_date,
                'passport_number' => $request->passport_number,
                'nationality' => $request->nationality,
                'residence_number' => $request->residence_number,
            ]);
    
            return response()->json(['status' => 'success', 'data' => $user], 200);
    
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'error' => $th->getMessage()], 500);
        }
    }
    /*****************************************************************************************/
    public function resetUserPassword(Request $request)
    {
        try {
            // Validate input
            $validator = Validator::make($request->all(), [
                'new_password' => 'required|min:8|confirmed',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation error',
                    'errors' => $validator->errors(),
                ], 422);
            }

            // Get the authenticated owner
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'User not authenticated.',
                ], 401);
            }

            // Update the password
            $user->password = Hash::make($request->new_password);
            $user->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Password updated successfully.',
            ]);
        } catch (\Exception $e) {
            return response()->json( [
                'status' => 'error',
                'message' => $e->getMessage(),

            ], 500);
        }
    }

}
