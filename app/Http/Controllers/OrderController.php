<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Interfaces\OrderInterface;

class OrderController extends Controller
{
    protected $order;
    public function __construct(OrderInterface $order){
        $this->order = $order;
    }

    public function index(){

        $orders=$this->order->index();
        return view('order.index',compact('orders'));

    }

    public function store(Request $request){

        $order=$this->order->store($request->all());
        if($order){
            return response()->json([
                'success' => true,
                'message' => 'Order placed successfully!',
            ], 200);
        }

    }

    public function show($id){

        $order=$this->order->show($id);

        if($order){
            return response()->json(['success' => true, 'order' => $order]);
        }

    }

    public function status(Request $request, $id){

        $order=$this->order->status($request->all(), $id);
        if($order){
            return response()->json(['success' => true, 'order' => $order]);
        }
    }

    public function updateStatus(Request $request, $id){

        $order=$this->order->updateStatus($request->all(), $id);
        if($order){
            return response()->json(['success' => true, 'order' => $order]);
        }
    }


    public function delete($id){

        $this->order->delete($id);
    }






}
