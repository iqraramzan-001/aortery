<?php

namespace App\Http\Controllers;

use App\Models\WareHouse;
use Illuminate\Http\Request;

class WareHouseController extends Controller
{


    public function store(Request $request){
        $warehouse=WareHouse::create([
            'name'=>$request->house_name,
            'location'=>$request->location,
            'open_from'=>$request->open_from,
            'open_to'=>$request->open_to,
            'company_id'=>$request->company_id,
        ]);
        if ($warehouse) {
            return response()->json([
                'status' => 'success',
                'message' => 'WareHouse Added Successfully'
            ], 200);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Failed to add warehouse'
            ], 500);
        }
    }

    public function destroy($id){
        $house=WareHouse::where('id',$id)->delete();
        if($house){
            return redirect()->back()->with('success', 'WareHouse deleted successfully');
        }
    }

}
