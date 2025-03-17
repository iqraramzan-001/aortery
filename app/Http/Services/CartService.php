<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Product;

use App\Http\Interfaces\CartInterface;

class CartService implements CartInterface
{

    public function __construct(Cart $cart){
        $this->model = $cart;

    }
    public function index()
    {
        $cartItems = [];

        if (auth()->check()) {

            $userId = getLoggedUserId();
        $cartItems = $this->model::with('product')->where('buyer_id', $userId)->get();


//            foreach ($dbCartItems as $item) {
//                $cartItems[] = [
//                    'product_id' => $item->product_id,
//                    'quantity'   => $item->quantity,
//                    'product'    => $item->product,
//                ];
//            }
        }


        $cart = session()->get('cart', []);

        if (!empty($cart)) {
            // 🟢 Get Product IDs from Session Cart
            $productIds = array_keys($cart);
            $products = \App\Models\Product::whereIn('id', $productIds)->get()->keyBy('id');

            // 🟢 Convert Session Cart to Array Format
            foreach ($cart as $productId => $item) {
                if (isset($products[$productId])) {
                    $cartItems[] = [
                        'product_id' => $productId,
                        'quantity'   => $item['quantity'],
                        'product'    => $products[$productId], // ✅ Properly fetched product
                    ];
                }
            }
        }

        return  $cartItems;
    }



    public function store($data)
    {




        $product = Product::where('id',$data['product_id'])->first();

            if(Auth::check()){
                $buyerId=getLoggedUserId();
                if($product){
                    $cart = Cart::updateOrCreate(
                        ['buyer_id' => $buyerId, 'product_id' => $product->id],
                        ['quantity' => $data['quantity'] ?? 1, 'price' => $product->price]
                    );
                }
              }
            else{
                $cart = session()->get('cart', []);

                if (isset($cart[$product->id])) {
                    $cart[$product->id]['quantity'] += $data['quantity'];
                }
                else {

                    $cart[$product->id] = [

                        'product_id' => $product->id,
                        'quantity'   =>$data['quantity'] ?? 1,
                    ];
                }

                session()->put('cart', $cart);
            }




        return $cart;

    }


    public function update($data, $id)
    {
        $userId=getLoggedUserId();
        $cart = $this->model::where('id', $id)->where('buyer_id',$userId)->firstOrFail();
        $cart->update(['quantity' => $data['quantity']]);
        return $cart;

//        return response()->json(['message' => 'Cart updated!', 'cart' => $cart]);
    }

    // ✅ Remove Item from Cart
    public function delete($id)
    {

        if (!auth()->check()) {


            $cart = session()->get('cart', []);

            foreach ($cart as $productId => $item) {
                if ($productId == $id) {
                    unset($cart[$productId]);
                    break;
                }
            }

            session()->put('cart', $cart);
            return true;



        }

        else{
            $userId=getLoggedUserId();
            return $this->model::where('id', $id)->where('buyer_id', $userId)->delete();
        }


    }

    public function clear()
    {
        $userId=getLoggedUserId();
        return Cart::where('buyer_id', $userId)->delete();
//        return response()->json(['message' => 'Cart cleared!']);
    }

    public function detail($id){

    }

}
