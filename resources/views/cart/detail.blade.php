@extends('front.layouts.layout')
@section('title', "Cart Details")

@section('content')
    <section class="support py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3 wow animated fadeInDown fw-bold"><i class="fa fa-user-tie me-2"></i> Buyer <span class="text-purple">Portal</span></h3>
                </div>
            </div>
            <div class="row align-items-stretch">
                <div class="col-12 my-4 wow animated fadeInDown">
                    <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Cart</h3>
                            <!-- <a href="new-password.html" class="text-purple fs-14">Change Password</a> -->
                        </div>
                        <hr />
                        <!-- Success & Error Message Display -->
                        <div id="orderMessage" class="mt-3"></div>
                        @if(!Auth::check())
                            @if($carts && count($carts) > 0)
                                @foreach($carts as $cart)
                                    @php
                                        $product = $cart['product'] ?? null;
                                      $firstImage = null;
                                            if ($product && isset($product->images) && $product->images->isNotEmpty()) {
                                                $image = $product->images->first();
                                                $firstImage = ($image->type === 'external') ? $image->file : asset('docs/' . $image->file);
                                            }
                                        $productName = $product->name ?? 'Unknown Product';
                                        $productPrice = $product->price ?? '0';
                                        $quantity = $cart['quantity'] ?? 1;
                                        $supplierName = $product && isset($product->supplier)
                                            ? ($product->supplier->first_name . ' ' . $product->supplier->last_name)
                                            : 'Unknown Supplier';
                                    @endphp

                                    <div class="order-box shadow-sm transition px-4 py-1 mt-4 rounded-2 p-4 position-relative cart-item-{{ $cart['product_id'] }}">
                                        <button data-id="{{ $cart['product_id'] }}" class="btn btn-danger delete-cart-item rounded-circle fs-12 position-absolute top-0 start-100 translate-middle p-0 px-1">
                                            <i class="fa fa-times"></i>
                                        </button>

                                        <div class="row align-items-stretch">
                                            <div class="col-lg-2 col-md-4 col-sm-4 my-3">
                                                <div class="bg-white border p-3 rounded-2 h-100">
                                                    @if($firstImage)
                                                        <img src="{{$firstImage}}" class="img-fluid object-fit-cover h-100" />
                                                    @else
                                                        <p>No Image</p>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-10 col-md-8 col-sm-8 my-3">
                                                <h3 class="h5 lh-125">{{ $productName }}</h3>
                                                <div class="d-flex gap-3 my-3 align-items-center">
                                                    <strong class="product-price" data-price="{{ $productPrice }}">${{ $productPrice }}</strong>
                                                    <input type="number" class="form-control text-center w-50p shadow-none quantity-input" value="{{ $quantity }}" min="1" data-price="{{ $productPrice }}" />
                                                    <a href="javascript:;" class="text-purple fs-13">Edit Amount</a>
                                                </div>
                                                <p class="fs-13 d-block mt-4">
                                                    Supplier: {{ $supplierName }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p>No products in cart.</p>
                            @endif
                        @else
                            @foreach($carts as $cart)

                                <div class="order-box shadow-sm transition px-4 py-1 mt-4 rounded-2 p-4 position-relative cart-item-{{ $cart->id }}">
                                    <button data-id="{{ $cart->id }}" class="btn btn-danger delete-cart-item rounded-circle fs-12 position-absolute top-0 start-100 translate-middle p-0 px-1">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <div class="row align-items-stretch">
                                        <div class="col-lg-2 col-md-4 col-sm-4 my-3">
                                            @php
                                                $firstImage = $cart->product->images->first();
                                                $imageUrl = ($firstImage && $firstImage->type === 'external') ? $firstImage->file : asset('docs/' . ($firstImage->file ?? 'default.jpg'));
                                            @endphp

                                            <div class="bg-white border p-3 rounded-2 h-100">
                                                <img src="{{ $imageUrl }}" class="img-fluid object-fit-cover h-100" />
                                            </div>
                                        </div>
                                        <div class="col-lg-10 col-md-8 col-sm-8 my-3">
                                            <h3 class="h5 lh-125">{{$cart->product->name}}</h3>
                                            <div class="d-flex gap-3 my-3 align-items-center">
                                                <strong class="product-price" data-price="{{ $cart->product->price }}">${{ $cart->product->price }}</strong>
                                                <input type="number" class="form-control text-center w-50p shadow-none quantity-input" value="{{$cart->quantity}}" min="1" data-price="{{ $cart->product->price }}" />
                                                <a href="javascript:;" class="text-purple fs-13">Edit Amount</a>
                                            </div>
                                            <p class="fs-13 d-block mt-4">
                                                Supplier: {{ $cart->product->supplier->first_name . ' ' . $cart->product->supplier->last_name }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                             @endforeach
                        @endif







                        <div class="bg-light rounded-2 border mt-5 px-4 d-flex align-items-center justify-content-between w-100">
                            <strong class="d-block py-3">Total: $<span id="total-price">0.00</span></strong>
                            @if(Auth::check())
                            <button id="placeOrderBtn"  class="btn btn-purple px-4 rounded-pill my-3">Place Order</button>
                            @else
                            <a href="{{route('login')}}" class="btn btn-purple px-4 rounded-pill my-3">Place Order</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <script>
        function calculateTotal() {
            let total = 0;

            document.querySelectorAll('.quantity-input').forEach(function(input) {
                let price = parseFloat(input.getAttribute('data-price'));
                let quantity = parseInt(input.value);
                total += price * quantity;
            });

            document.getElementById('total-price').textContent = total.toFixed(2);
        }


        document.addEventListener("DOMContentLoaded", function() {
            calculateTotal();
        });


        document.querySelectorAll('.quantity-input').forEach(function(input) {
            input.addEventListener('input', function() {
                calculateTotal();
            });
        });
    </script>
@endsection
