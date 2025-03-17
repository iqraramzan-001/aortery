<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactUs;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function home(){
        $categories=Category::where('parent_id',null)->get();
        return view('front.pages.home',compact('categories'));
    }

    public function support()
    {
        return view('support.help-center');
    }

    public function contact(Request $request){

        $msg = ContactUs::create([
            'name' => $request->name,
            'email' =>$request->email,
            'issue_type' =>$request->issue_type,
            'message' => $request->message,
        ]);
        if($msg){
            return redirect()->back()->with('success',"Message Submitted Successfully");
        }

    }
}
