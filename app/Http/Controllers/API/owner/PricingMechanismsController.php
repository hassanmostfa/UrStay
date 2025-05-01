<?php

namespace App\Http\Controllers\API\owner;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\PricingMechanism;
use App\Models\CompletedUnit;

class PricingMechanismsController extends Controller
{
    // get all pricing mechanisms for current owner
    public function index(){
        $pricing_mechanisms = PricingMechanism::where('owner_id', auth()->user()->id)->get();
        return response()->json([
            'status' => 'success',
            'pricing_mechanisms' => $pricing_mechanisms 
        ], 200);
    }
    
    /**************************************************************************************/
    // get unit pricing mechanisms for authenticated owner
    public function getUnitPricingMechanisms($unit_id){
        $pricing_mechanisms = PricingMechanism::where('owner_id', auth()->user()->id)
        ->where('unit_id', $unit_id)
        ->get();

        if ($pricing_mechanisms->isEmpty()) {
            return response()->json([
                'status' => 'error',
                'message' => 'No pricing mechanisms found for the unit'
            ]);
        }

        return response()->json([
            'status' => 'success',
            'pricing_mechanisms' => $pricing_mechanisms 
        ], 200);
    }
    /**************************************************************************************/

    // create a new pricing mechanism
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'unit_id' => 'required',
            'name' => 'required',
            'saturday_price' => 'required',
            'midweek' => 'required',
            'thursday_price' => 'required',
            'friday_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error','message' => $validator->errors()->first(),
            ], 400);
        }

        // check if unit is completed or not
        $completedUnit = CompletedUnit::where('unit_id', $request->unit_id)->first();

        if (!$completedUnit) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unit is not completed yet',
            ], 400);
        }
        try{
            $pricing_mechanism = new PricingMechanism();
            $pricing_mechanism->unit_id = $request->unit_id;
            $pricing_mechanism->owner_id = auth()->user()->id;
            $pricing_mechanism->name = $request->name;
            $pricing_mechanism->saturday_price = $request->saturday_price;
            $pricing_mechanism->midweek = $request->midweek;
            $pricing_mechanism->thursday_price = $request->thursday_price;
            $pricing_mechanism->friday_price = $request->friday_price;
            $pricing_mechanism->start_date = $request->start_date ?? null;
            $pricing_mechanism->end_date = $request->end_date ?? null;
            $pricing_mechanism->periority = $request->periority ?? null;
            $pricing_mechanism->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Pricing mechanism created successfully',
                'pricing_mechanism' => $pricing_mechanism
            ], 201);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while creating the pricing mechanism',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**************************************************************************************/

    // update a pricing mechanism
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'saturday_price' => 'required',
            'midweek' => 'required',
            'thursday_price' => 'required',
            'friday_price' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error','message' => $validator->errors()->first(),
            ], 400);
        }

        try{
            $pricing_mechanism = PricingMechanism::findOrFail($id);
            if (!$pricing_mechanism) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pricing mechanism not found',
                ], 404);
            }

            $pricing_mechanism->unit_id = $request->unit_id ?? $pricing_mechanism->unit_id; 
            $pricing_mechanism->name = $request->name ?? $pricing_mechanism->name;
            $pricing_mechanism->saturday_price = $request->saturday_price ?? $pricing_mechanism->saturday_price;
            $pricing_mechanism->midweek = $request->midweek ?? $pricing_mechanism->midweek;
            $pricing_mechanism->thursday_price = $request->thursday_price ?? $pricing_mechanism->thursday_price;
            $pricing_mechanism->friday_price = $request->friday_price ?? $pricing_mechanism->friday_price;
            $pricing_mechanism->start_date = $request->start_date ?? $pricing_mechanism->start_date;
            $pricing_mechanism->end_date = $request->end_date ?? $pricing_mechanism->end_date;
            $pricing_mechanism->periority = $request->periority ?? $pricing_mechanism->periority;
            $pricing_mechanism->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Pricing mechanism updated successfully',
                'pricing_mechanism' => $pricing_mechanism
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while updating the pricing mechanism',
                'error' => $e->getMessage()
            ], 500);
        }
    }
    /**************************************************************************************/
    // delete a pricing mechanism
    public function destroy($id){
        try{
            $pricing_mechanism = PricingMechanism::findOrFail($id);
            if (!$pricing_mechanism) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Pricing mechanism not found',
                ], 404);
            }

            $pricing_mechanism->delete();

            return response()->json([
                'status' => 'success',
                'message' => 'Pricing mechanism deleted successfully',
            ], 200);
        }catch(\Exception $e){
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while deleting the pricing mechanism',
                'error' => $e->getMessage()
            ], 500);
        }
    }

}
