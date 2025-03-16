<?php

namespace App\Http\Controllers;
use App\Http\Interfaces\CartInterface;

use Illuminate\Http\Request;

class CartController extends Controller
{
    protected $cart;
    public function __construct(CartInterface $cart){
        $this->cart = $cart;
    }

    public function index(){
        $carts=$this->cart->index();
        return view('cart.detail',compact('carts'));
    }
    public function store(Request $request){
        try {

            $cart = $this->cart->store($request->all());



            return response()->json([
                'success' => true,
                'message' => "Item added to cart!",
                'cart' => $cart
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "Failed to add item to cart!"
            ], 500);
        }
    }

    public function destroy($id){
        $cart=$this->cart->delete($id);
        if($cart){
            return redirect()->back()->with('success', 'Cart item deleted successfully');
        }
}





}
