<?php

namespace App\Http\Controllers\API\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\UserBankAccount;
use App\Models\UserWallet;
class UserBankAccountController extends Controller
{
    // get my bank accounts
    public function index(){
        try{
            $bankAccounts = UserBankAccount::where('user_id', Auth::user()->id)->get();
            return response()->json([
                'status' => 'success',
                'data' => $bankAccounts,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }
    /*******************************************************************************/

    // create bank account
    public function store(Request $request){
        try{
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required',
                'iban' => 'required',
                'name_on_account' => 'required',
                'swift_code' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            // get owner wallet
            $wallet = UserWallet::where('user_id', Auth::user()->id)->first();

            if (!$wallet) {
                return response()->json([
                    'status' => 'error',
                    'msg' => 'Wallet not found',
                ]);
            }

            $bankAccount = new UserBankAccount();
            $bankAccount->user_id = Auth::user()->id;
            $bankAccount->wallet_id = $wallet->id;
            $bankAccount->bank_name = $request->bank_name;
            $bankAccount->iban = $request->iban;
            $bankAccount->name_on_account = $request->name_on_account;
            $bankAccount->swift_code = $request->swift_code;
            $bankAccount->save();

            return response()->json([
                'status' => 'success',
                'data' => $bankAccount,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }
    /*********************************************************************************/
    // update bank account
    public function update(Request $request, $id){
        try{
            $validator = Validator::make($request->all(), [
                'bank_name' => 'required',
                'iban' => 'required',
                'name_on_account' => 'required',
                'swift_code' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 422);
            }

            $bankAccount = UserBankAccount::findOrFail($id);
            $bankAccount->bank_name = $request->bank_name;
            $bankAccount->iban = $request->iban;
            $bankAccount->name_on_account = $request->name_on_account;
            $bankAccount->swift_code = $request->swift_code;
            $bankAccount->save();

            return response()->json([
                'status' => 'success',
                'data' => $bankAccount,
            ]);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'msg' => $e->getMessage(),
            ]);
        }
    }
}
