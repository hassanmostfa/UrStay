<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UserAdditionalInfo;

class AdditionalInfoController extends Controller
{
    // get user additional info
    public function index()
    {
        $user_additional_info = UserAdditionalInfo::where('user_id', auth()->user()->id)->first();

        if (!$user_additional_info) {
            return response()->json([
                'status' => 'not found',
                'msg' => 'User additional info not found please create one first',
                'data' => null
            ]);
        }
        return response()->json([
            'status' => 'success',
            'data' => $user_additional_info
        ]);
    }

    public function store(Request $request)
    {
        // Validate request data
        $request->validate([
            'location' => 'nullable|string|max:255',
            'work' => 'nullable|string|max:255',
            'preferred_languages' => 'nullable|array',
            'preferred_languages.*' => 'string|max:255',
            'preferred_places' => 'nullable|array',
            'preferred_places.*' => 'string|max:255',
            'about' => 'nullable|string',
            'interests' => 'nullable|array',
            'interests.*' => 'string|max:255',
        ]);
    
        // Create or update the user's additional info
        $additionalInfo = UserAdditionalInfo::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'location' => $request->location,
                'work' => $request->work,
                'preferred_languages' => $request->preferred_languages,
                'preferred_places' => $request->preferred_places,
                'about' => $request->about,
                'interests' => $request->interests,
            ]
        );
    
        return response()->json([
            'message' => 'User additional info stored successfully',
            'data' => $additionalInfo
        ], 200);
    }

    public function update(Request $request)
    {
        // Validate request data
        $request->validate([
            'location' => 'nullable|string|max:255',
            'work' => 'nullable|string|max:255',
            'preferred_languages' => 'nullable|array',
            'preferred_languages.*' => 'string|max:255',
            'preferred_places' => 'nullable|array',
            'preferred_places.*' => 'string|max:255',
            'about' => 'nullable|string',
            'interests' => 'nullable|array',
            'interests.*' => 'string|max:255',
        ]);
    
        // Find the additional info by user_id
        $additionalInfo = UserAdditionalInfo::where('user_id', Auth::id())->first();
    
        // If no record exists, create one
        if (!$additionalInfo) {
            $additionalInfo = new UserAdditionalInfo();
            $additionalInfo->user_id = Auth::id();
        }
    
        // Update the record
        $additionalInfo->location = $request->location;
        $additionalInfo->work = $request->work;
        $additionalInfo->preferred_languages = $request->preferred_languages;
        $additionalInfo->preferred_places = $request->preferred_places;
        $additionalInfo->about = $request->about;
        $additionalInfo->interests = $request->interests;
        $additionalInfo->save();
    
        return response()->json([
            'message' => 'User additional info updated successfully',
            'data' => $additionalInfo
        ], 200);
    }

    public function destroy()
{
    // Find the additional info by user_id
    $additionalInfo = UserAdditionalInfo::where('user_id', Auth::id())->first();

    // If no record found, return error
    if (!$additionalInfo) {
        return response()->json(['message' => 'User additional info not found'], 404);
    }

    // Delete the record
    $additionalInfo->delete();

    return response()->json(['message' => 'User additional info deleted successfully'], 200);
}

}
