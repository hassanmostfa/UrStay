<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\UserWallet;

class UserWalletController extends Controller
{
    // get user wallet
    public function index(){
        try{
            $user = Auth::user();
            $wallet = UserWallet::where('user_id', $user->id)->first();
            return response()->json(['status' => 'success','data' => ['wallet' => $wallet , 'user' => $user]], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','data' => $th->getMessage()], 500);
        }
    }
/*************************************************************************************/

    // add money to wallet
    public function addMoney(Request $request , $userId){
        try{
            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            $wallet = UserWallet::where('user_id', $userId)->first();

            if (!$wallet) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Wallet not found',
                ]);
            }

            $wallet->balance += $request->input('amount');
            $wallet->save();

            return response()->json(['status' => 'success', 'msg' => 'Money added successfully','data' => $wallet], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','data' => $th->getMessage()], 500);
        }
    }

    /**************************************************************************************/

    // withdraw money from wallet
    public function withdrawMoney(Request $request , $userId){
        try{
            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            $wallet = UserWallet::where('user_id', $userId)->first();

            if (!$wallet) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Wallet not found',
                ]);
            }
            
            if ($wallet->balance < $request->input('amount')) {
                return response()->json(['status' => 'error', 'msg' => 'Insufficient balance', 'data' => null], 422);
            }

            $wallet->balance -= $request->input('amount');
            $wallet->save();

            return response()->json(['status' => 'success', 'msg' => 'Withdrawal successful','data' => $wallet], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','data' => $th->getMessage()], 500);
        }
    }

    /**************************************************************************************/
}
