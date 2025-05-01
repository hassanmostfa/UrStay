<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\Wallet;

class WalletController extends Controller
{
    // get owner wallet
    public function index(){
        try{
            $owner = Auth::user();
            $wallet = Wallet::where('owner_id', $owner->id)->first();
            return response()->json(['status' => 'success','data' => ['wallet' => $wallet , 'owner' => $owner]], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','data' => $th->getMessage()], 500);
        }
    }
/*************************************************************************************/

    // add money to wallet
    public function addMoney(Request $request , $ownerId){
        try{
            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            $wallet = Wallet::where('owner_id', $ownerId)->first();

            $wallet->balance += $request->input('amount');
            $wallet->save();

            return response()->json(['status' => 'success', 'msg' => 'Money added successfully','data' => $wallet], 200);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','data' => $th->getMessage()], 500);
        }
    }

    /**************************************************************************************/

    // withdraw money from wallet
    public function withdrawMoney(Request $request , $ownerId){
        try{
            $validator = Validator::make($request->all(), [
                'amount' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            $wallet = Wallet::where('owner_id', $ownerId)->first();

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
