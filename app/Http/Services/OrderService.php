<?php

namespace App\Http\Services;


use App\Http\Interfaces\OrderInterface;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use App\Traits\FileUploads;
use Illuminate\Support\Facades\DB;
use function PHPUnit\Framework\throwException;
use App\Models\Product;

class OrderService implements OrderInterface
{
    use FileUploads;

    public function __construct(Order $order,Orderitem $item, Cart $cart){
        $this->order = $order;
        $this->item=$item;
        $this->cart=$cart;

    }

    public function index()
    {
        $userId = getLoggedUserId();
        $user = auth()->user();

        if ($user->type == User::TYPE_SUPPLIER) {

            $orders = $this->order::with(['buyer', 'supplier', 'items.product'])
                ->where('supplier_id', $userId)
                ->latest()
                ->get();
        } elseif ($user->type == User::TYPE_BUYER) {
            $orders = $this->order::with(['buyer', 'supplier', 'items.product'])
                ->where('buyer_id', $userId)
                ->latest()
                ->get();
        }

      return $orders;
    }

    public function store($data){
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $id=getLoggedUserId();
            $cartItems = Cart::where('buyer_id', $id)->get();

            if ($cartItems->isEmpty()) {
                return response()->json(['error' => 'Cart is empty!'], 400);
            }
            $supplierId = Product::whereIn('id', $cartItems->pluck('product_id'))->value('supplier_id');

            $totalPrice = $cartItems->sum(function ($cart) {
                return $cart->quantity * $cart->price;
            });

            $lastOrder = $this->order->latest('id')->value('order_no');
            $nextOrderNumber = $lastOrder ? str_pad((int) $lastOrder + 1, 4, '0', STR_PAD_LEFT) : '0001';
            $order = $this->order->create([
                'buyer_id' => getLoggedUserId(),
                'supplier_id' => $supplierId ?? 10,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'order_no' => $nextOrderNumber,
            ]);



            foreach ($cartItems as $cart) {
                $this->item->create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product_id,
                    'quantity' => $cart->quantity,
                    'price' => $cart->price
                ]);
            }

            Cart::where('buyer_id', $id)->delete();

            DB::commit();
            return $order;

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);
            return throwException($e);

        }
    }

    public function delete($id){
        return $this->order::findOrFail($id)->delete();
    }

    public function show($id)
    {
        $order = $this->order::with(['buyer', 'supplier', 'items.product.images'])->findOrFail($id);
        return $order;
    }

    public function status($data, $id)
    {

        $order =$this->order::findOrFail($id);
        $order->status = $data['status'];
        $order->save();

        foreach ($data['items'] as $itemData) {
            $orderItem = $this->item::find($itemData['id']);
            if ($orderItem) {
                $orderItem->status = $itemData['status'];
                $orderItem->notes = $itemData['note'];
                $orderItem->save();
            }
        }

        return $order;
    }

    public function updateStatus($data, $id)
    {
        $order =$this->item::findOrFail($id);

//        $itemTotalPrice = $orderItem->price * $orderItem->quantity;
//
//        // Subtract from order total price
//        $order->total_price -= $itemTotalPrice;
//        $order->save();
        $order->update(['status' => $data['status']]);
        return $order;
    }

}
