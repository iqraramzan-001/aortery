@extends('front.layouts.layout')

@section('title', "Order List")

@section('content')
    <section class="support py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3 wow animated fadeInDown fw-bold"><i class="fa fa-shop me-2"></i> Supplier <span class="text-purple">Portal</span></h3>
                </div>
            </div>
            @php

                use App\Models\User;


            @endphp
            <div class="row align-items-stretch">
             @include('components.admin-sidebar')
                <div class="col-lg-9 col-md-8 my-4 wow animated fadeInDown">
                    <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Orders</h3>
                            <!-- <a href="supplier-add-product.html" class="btn btn-outline-dark btn-sm rounded-pill px-3"><i class="fa fa-plus me-1"></i> Product</a> -->
                        </div>
                        <hr />
                        <div class="table-responsive my-3">
                            <input type="hidden"  id="userType" value="{{Auth::user()->type}}" />
                            <table class="table table-striped table-border">
                                <thead>
                                <tr>
                                    <th class="p-3 fs-14 bg-blue text-white">Time <a href="javascript:;" class="text-blue ms-1"><i class="fa fa-caret-down"></i></a></th>
                                    <th class="p-3 fs-14 bg-blue text-white">Order No.</th>
                                    @if (Auth::user()->type === User::TYPE_SUPPLIER)
                                        <th class="p-3 fs-14 bg-blue text-white">Buyer</th>
                                    @endif

                                    <th class="p-3 fs-14 bg-blue text-white">Amount <a href="javascript:;" class="text-blue ms-1"><i class="fa fa-caret-down"></i></a></th>
                                    <th class="p-3 fs-14 bg-blue text-white">Order Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td class="p-3 fs-13">{{$order->created_at}}</td>
                                        <td class="p-3 fs-13">
                                            <button class="btn btn-sm btn-purple order-details"
                                               data-order-id="{{ $order->id }}">
                                                {{ $order->order_no }}
                                            </button>
                                        </td>



                                        @if (Auth::user()->type === User::TYPE_SUPPLIER)
                                            <td class="p-3 fs-13">{{$order->buyer->company->name}}</td>
                                        @endif
                                        <td class="p-3 fs-13">{{$order->total_price}}</td>
                                        <td class="p-3 fs-13"><span class="alert alert-warning py-1 px-2 fs-12">{{$order->status}}</span></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <nav aria-label="Page navigation example" class="mt-5 mb-4 wow animated fadeInDown pag">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled"><a class="page-link p-3 fs-13"><i class="fa fa-angle-left"></i></a></li>
                                <li class="page-item"><a class="page-link p-3 fs-13 active bg-blue" href="javascript:;">1</a></li>
                                <li class="page-item"><a class="page-link p-3 fs-13" href="javascript:;">2</a></li>
                                <li class="page-item"><a class="page-link p-3 fs-13" href="javascript:;">3</a></li>
                                <li class="page-item"><a class="page-link p-3 fs-13" href="javascript:;">...</a></li>
                                <li class="page-item"><a class="page-link p-3 fs-13" href="javascript:;">31</a></li>
                                <li class="page-item">
                                    <a class="page-link p-3 fs-13" href="javascript:;"><i class="fa fa-angle-right"></i></a>
                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
    </section>
    <!-- Order Details Modal -->
    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel">

        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="orderDetailsModalLabel">Order Approval</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body py-4">
                    <div class="alert alert-secondary fs-14 py-0">

                            <input class="hidden order-id" />

                        <div class="row">

                            <div class="col-md-4 my-3">
                                <p class="lh-150">Order No.: <b id="modal-order-no"></b></p>
                            </div>
                            <div class="col-md-4 my-3">
                                <p class="lh-150">Date: <b id="modal-order-date"></b></p>
                            </div>
                            <div class="col-md-4 my-3">
                                <p class="lh-150">Buyer: <b id="modal-buyer-name"></b></p>
                            </div>
                        </div>
                    </div>

                    <!-- Order Items List -->
                    <div id="order-items-list"></div>

                </div>

                <div class="modal-footer d-flex justify-content-between">
                    <strong>Total: $<span id="modal-order-price"></span></strong>
                    @if(Auth::user()->type==User::TYPE_SUPPLIER)
                    <div class="d-flex gap-3 align-items-center">
                        <button class="btn btn-danger px-3 rounded-pill update-status" data-status="declined">
                            <i class="fa fa-times me-1"></i> Decline Order
                        </button>
                        <button class="btn btn-success px-3 rounded-pill update-status" data-status="approved">
                            <i class="fa fa-check me-1"></i> Confirm
                        </button>

                    </div>
                        @else
                        <div class="d-flex gap-3 align-items-center">
                            <button  class="btn btn-danger px-3 update-status" data-status="canceled"><i class="fa fa-times me-1"></i> Cancel Order</button>
                            <a href="checkout.html" class="btn btn-success px-3 rounded-pill"><i class="fa fa-check me-1"></i> Checkout</a>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>


@endsection
