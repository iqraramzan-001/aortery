<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\BuyerInterface;
use App\Http\Interfaces\SupplierInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Company;
use App\Models\Supplier;

class SupplierController extends Controller
{
    protected $supplier;
    public function __construct(SupplierInterface $supplier){
        $this->supplier = $supplier;
    }

    public function create()
    {
        $userId = Auth::id();

        $company = Company::with('warehouses')->where('user_id', $userId)->first();


        $supplier = Auth::user()->supplier ? Supplier::where('id', Auth::user()->supplier->id)->first() : null;

        return view('supplier.profile', compact('company', 'supplier'));
    }

     public function profile(Request $request){
        $profile=$this->supplier->profile($request->all());
       if($profile)
       {
           return redirect()->back()->with('success',"Profile Updated Successfully");
       }


     }

     public function products(){
        $products=$this->supplier->products();
            return view("supplier.product",compact('products'));
     }
}
