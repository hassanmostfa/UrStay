<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;

class FaqsController extends Controller
{
    // get all faqs
    public function index(){
        $faqs = Faq::all();
        return response()->json(['status' => 'success','data' => $faqs] , 200);
    }

    // Create Faq
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'answer' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'msg' => $validator->errors()->first(),
                'data' => null,
                'notes' => ['Invalid data provided']
            ], 400);
        }

        $faq = new Faq();
        $faq->question = $request->question;
        $faq->answer = $request->answer;
        $faq->status = $request->status;
        $faq->save();

        return response()->json([
            'status' => 'success',
            'msg' => 'Faq added successfully',
            'data' => ['faq' => $faq],
        ], 201);
    }

    
}
