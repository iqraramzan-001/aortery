<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\BuyerInterface;
use App\Models\Company;
use App\Models\Buyer;
use App\Models\DeliveryLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BuyerController extends Controller
{
    protected $buyer;
    public function __construct(BuyerInterface $buyer){
        $this->buyer = $buyer;
    }

    public function create(){

        $userId = Auth::id();

        $company = Company::where('user_id', $userId)->first();


        $buyer = Auth::user()->buyer ? Buyer::with('locations')->where('id', Auth::user()->buyer->id)->first() : null;

        return view('buyer.profile',compact('company','buyer'));
    }

     public function profile(Request $request){
         $profile=$this->buyer->profile($request->all());

         if($profile)
         {
             return redirect()->back()->with('success',"Profile Updated Successfully");
         }

     }
    public function deleteLocation($id){
        $house=DeliveryLocation::where('id',$id)->delete();
        if($house){
            return response()->json([
                'status' => 'success',
                'message' => 'Location Deleted Successfully'
            ], 200);
        }
    }
}
