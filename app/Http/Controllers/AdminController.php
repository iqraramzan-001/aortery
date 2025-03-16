<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Supplier;
use App\Models\User;
use App\Models\Buyer;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function dashboard(){
        return view('admin.dashboard');
    }

    public function approval(){

        $company = Company::with(['supplier', 'buyer'])->paginate(2);

        return view('admin.approval',compact('company'));
    }
    public function viewProfile($id){

        $user = User::findOrFail($id);

        $company=Company::with('warehouses','documents')->where('user_id',$id)->first();

        if ($user->type === 'supplier') {

            $supplier=Supplier::where('user_id', $id)->first();
            return view('supplier.profile',compact('company','supplier'));

        } else {
            $buyer=Buyer::where('user_id', $id)->first();

            return view('supplier.profile',compact('company','buyer'));
        }


    }

    public function updateStatus($id, $status)
    {
        $user = User::findOrFail($id);

        if ($user->type === 'supplier') {

            Supplier::where('user_id', $id)->update(['status' => $status]);

        } else {
            Buyer::where('user_id', $id)->update(['status' => $status]);
        }

        return response()->json(['message' => 'Status updated successfully']);
    }


    public function destroy($id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);

            if (!$user) {
                return redirect()->back()->with('error', 'User not found');
            }

            Company::where('user_id', $id)->delete();

            if ($user->type === 'supplier') {
                Supplier::where('user_id', $id)->delete();
            }
            else {
                Buyer::where('user_id', $id)->delete();
            }

            $user->delete();

            DB::commit();

            return redirect()->back()->with('success', 'User deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Something went wrong: ' . $e->getMessage());
        }
    }


}
