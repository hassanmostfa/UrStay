<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;

class TransactionsController extends Controller
{
    // Get All Transactions
    public function index(){
        try{
            $transactions = Transaction::all();
            return response()->json(['status' => 'success','data' => $transactions,]);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','msg' => $th->getMessage(),
            ]);
        }
    }

    /********************************************************************************/
    // Get Authenticated Owner Transactions
    public function ownerTransactions(){
        try{
            $owner = Auth::user();
            $transactions = Transaction::where('owner_id', $owner->id)->get();
            return response()->json(['status' => 'success','data' => $transactions,]);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','msg' => $th->getMessage(),
            ]);
        }
    }

    /*********************************************************************************/
    // create Transaction
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'amount' => 'required',
            'type' => 'required',
            'owner_id' => 'required',
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'msg' => $validator->errors()->first(), 'data' => null], 422);
        }

        try{
            $transaction = new Transaction();
            $transaction->amount = $request->amount;
            $transaction->type = $request->type;
            $transaction->owner_id = $request->owner_id;
            $transaction->user_id = $request->user_id;
            if ($request->description) {
                $transaction->description = $request->description;
            }

            if ($request->status) {
                $transaction->status = $request->status;
            }

            $transaction->save();
            return response()->json(['status' => 'success','data' => $transaction,]);
        }catch(\Throwable $th){
            return response()->json(['status' => 'error','msg' => $th->getMessage(),]);
        }
    }
}
