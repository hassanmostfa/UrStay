<?php

namespace App\Http\Controllers\MVC;

use App\Http\Controllers\Controller;
use App\Models\Phone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Services\ForJawalyService;
use Carbon\Carbon;

class AuthController extends Controller
{
    protected $forJawalyService;

    public function __construct(ForJawalyService $forJawalyService)
    {
        $this->forJawalyService = $forJawalyService;
    }


    public function sendOtp(Request $request)
    {
        // Validate the phone number
        $validator = Validator::make($request->all(), [
            'phone' => 'required',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 400);
        }

        $phone = $request->phone;
        $verificationCode = rand(100000, 999999);

        // Check if the phone number already exists in the database
        $phoneRecord = Phone::where('phone', $phone)->first();
        $expirationTime = Carbon::now()->addMinutes(10);

        if ($phoneRecord) {
            // If the phone exists, update the verification code and expiration time
            $phoneRecord->verification_code = Hash::make($verificationCode);
            $phoneRecord->verified_at = null;
            $phoneRecord->current_code_expired_at = $expirationTime;
            $phoneRecord->save();
        } else {
            // Create a new phone record
            Phone::create([
                'phone' => $phone,
                'verification_code' => Hash::make($verificationCode),
                'current_code_expired_at' => $expirationTime,
            ]);
        }

        Log::info("Sending OTP to {$phone} with code {$verificationCode}");

        try {
            // Sending SMS via service
            $result = $this->forJawalyService->sendSMS($phone, "Your UrStay account verification code is: {$verificationCode}");

            if ($result['code'] === 200) {
                return response()->json([
                    'success' => true,
                    'message' => 'OTP sent successfully',
                    'phone' => $phone,
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => $result['message'] ?? 'An error occurred while sending OTP',
                ], 500);
            }
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again later.',
            ], 500);
        }
    }

    public function verifyOtp(Request $request)
    {
        // Validate the request inputs
        $request->validate([
            'otp' => 'required|digits:6',
            'phone' => 'required', // Customize the regex to your requirements
        ]);

        $phone = $request->phone;

        // Retrieve the phone record from the database
        $phoneRecord = Phone::where('phone', $phone)->first();

        if (!$phoneRecord) {
            return response()->json([
                'success' => false,
                'message' => 'Phone number not found.',
            ], 404);
        }

        // Check if the OTP has expired
        if (Carbon::now()->greaterThan($phoneRecord->current_code_expired_at)) {
            return response()->json([
                'success' => false,
                'message' => 'OTP has expired. Please request a new one.',
            ], 400);
        }

        // Check if the OTP matches the hashed verification code using Hash::check
        if (Hash::check($request->otp, $phoneRecord->verification_code)) {
            // Mark the phone as verified by setting verified_at timestamp
            $phoneRecord->verified_at = now();
            $phoneRecord->save();

            return response()->json([
                'success' => true,
                'message' => 'Phone number verified successfully.',
                'phone' => $phone,
                'isVerified' => true,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again.',
            ], 400);
        }
    }


    // Resend OTP to user
    // public function resendOtp(Request $request)
    // {
    //     $phone = $request->session()->get('phone');

    //     if (!$phone) {
    //         return response()->json(['status' => 'error', 'message' => 'You must request OTP first'], 422);
    //     }

    //     $verificationCode = rand(100000, 999999);
    //     $request->session()->put('verificationCode', $verificationCode);

    //     \Log::info("Resending OTP to {$phone} with code {$verificationCode}");

    //     try {
    //         $result = $this->forJawalyService->sendSMS($phone, "Your UrStay account verification code is: {$verificationCode}");

    //         if ($result['code'] === 200) {
    //             \Log::info("Message sent successfully.");
    //             return response()->json(['status' => 'success', 'message' => 'OTP resent successfully.']);
    //         } else {
    //             \Log::error('Error resending OTP: ' . json_encode($result));
    //             return response()->json(['status' => 'error', 'message' => $result['message'] ?? 'An error occurred while resending OTP'], 422);
    //         }
    //     } catch (\Exception $e) {
    //         \Log::error('Error resending OTP: ' . $e->getMessage());
    //         return response()->json(['status' => 'error', 'message' => 'Failed to resend OTP. Please try again later.'], 500);
    //     }
    // }
}
