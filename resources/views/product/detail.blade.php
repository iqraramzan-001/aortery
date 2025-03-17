@extends('front.layouts.layout')
@section('title', "Product Details")
@section('content')

    <div class="container">
        <div class="row aling-items-stretch py-md-4">
            @include('product.components.sidebar')
            <div class="col-xl-9 xol-lg-8 col-md-8">
                <div class="h-100">
                    <div class="bg-white rounded-2 shadow-sm px-4 py-1 mt-4 wow animated fadeInRight">
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold wow animated fadeInRight my-3 filtertitle">Product Details</h3>
                            <div class="d-flex gap-2 align-items-center change-view" id="mobile">
                                <input type="radio" class="btn-check" name="options-base1" id="option3" autocomplete="off" checked />
                                <label class="btn btn-sm" for="option3"><i class="fa fa-table"></i></label>

                                <input type="radio" class="btn-check" name="options-base1" id="option4" autocomplete="off" />
                                <label class="btn btn-sm" for="option4"><i class="fa fa-list"></i></label>
                            </div>
{{--                            <div class="d-sm-flex align-items-cneter gap-2 my-3 filters">--}}
{{--                                <form class="position-relative search-bar w-auto my-0 wow animated fadeInRight" role="search">--}}
{{--                                    <input class="form-control w-100 shadow-none rounded-pill fs-14" type="search" placeholder="Search" aria-label="Search" />--}}
{{--                                    <button class="btn bnt-light border-0 shadow-none position-absolute start-0 top-0" type="submit"><i class="fa fa-search"></i></button>--}}
{{--                                </form>--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <nav style="--bs-breadcrumb-divider: '>';" aria-label="breadcrumb" class="mt-4 wow animated fadeInDown">
                        <ol class="breadcrumb fs-13">
                            <li class="breadcrumb-item"><a href="{{route('product.index')}}" class="text-blue">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                            <li class="breadcrumb-item active" aria-current="page">Sub Category</li>
                            <li class="breadcrumb-item active" aria-current="page">Active</li>
                        </ol>
                    </nav>
                    <div class="row align-items-center">
                        <div class="col-lg-6 my-4">
                            <div id="productDetails" class="carousel slide position-relative">
                                <!-- Indicators -->

                                <div id="cartMessage"></div>
                                <div class="carousel-indicators">


                                    @foreach($product->images as $index => $image)
                                        @php
                                            $imageUrl = ($image->type === 'external') ? $image->file : asset('docs/' . $image->file);
                                        @endphp

                                        <button type="button" data-bs-target="#productDetails" data-bs-slide-to="{{ $index }}"
                                                class="{{ $index == 0 ? 'active' : '' }}"
                                                aria-label="Slide {{ $index + 1 }}">
                                            <img src="{{ $imageUrl }}" alt="Product Image"
                                                 class="img-fluid object-fit-contain" />
                                        </button>
                                    @endforeach

                                </div>

                                <!-- Carousel Items -->
                                <div class="carousel-inner">
                                    @foreach($product->images as $index => $image)

                                        @php
                                            $imageUrl = ($image->type === 'external') ? $image->file : asset('docs/' . $image->file);
                                        @endphp
                                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                            <div class="bg-white h-100 text-center rounded-2 p-4 p-lg-5 position-relative">

                                                <img src="{{ $imageUrl }}" alt="Product Image"
                                                     class="img-fluid object-fit-contain mm-h-350" />
                                            </div>
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Controls -->
                                <button class="carousel-control-prev text-darks" type="button" data-bs-target="#productDetails" data-bs-slide="prev">
                                    <i class="fa fa-chevron-left"></i>
                                </button>
                                <button class="carousel-control-next text-darks" type="button" data-bs-target="#productDetails" data-bs-slide="next">
                                    <i class="fa fa-chevron-right"></i>
                                </button>
                            </div>
                        </div>


                        <div class="col-lg-6 my-4 ps-xl-5">
                            <div class="h-100 mt-5 mt-lg-0 pt-4 pt-lg-0">
                                <h3 class="h4 fw-bold wow animated fadeInDown">{{$product->name}}</h3>
                                <input type="hidden" class="productId" value="{{$product->id}}">
                                <div class="d-flex gap-3 my-3 wow animated fadeInDown">
                                    <div class="d-flex gap-1">
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                        <i class="fa fa-star text-warning"></i>
                                    </div>
                                    <span class="fs-14 opacity-50 wow animated fadeInDown">55 Customers Review</span>
                                </div>
                                <span class="text-purple fs-5 d-block mt-4 wow animated fadeInDown"><del class="opacity-25 text-darks">$125.00</del> -  <b>${{$product->price}}</b></span>
                                <ul class="mt-4">
                                    <li class="d-flex py-1 gap-1 wow animated fadeInDown fs-14 lh-150"><strong>Supplier: </strong><p class="text-blue">{{$product->supplier->name}}</p></li>
                                    <li class="d-flex py-1 gap-1 wow animated fadeInDown fs-14 lh-150"><strong>Manufacturer: </strong><p>{{$product->manufacturer}}</p></li>
                                </ul>
                                <div class="d-sm-flex gap-3 align-items-center">
                                    <div id="field1" class="d-flex gap-2 align-items-center my-3">
                                        <button type="button" class="sub btn btn-sm btn-blue rounded-pill" data-id="1"><i class="fa fa-minus"></i></button>
                                        <input type="text" class="quantity-input form-control rounded-pill text-center shadow-none" data-id="1" value="1" min="1" max="999"/>
                                        <button type="button" class="add btn btn-sm btn-blue rounded-pill" data-id="1"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <button class="btn btn-purple px-4 rounded-pill my-3 addToCartBtn" data-id="1">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-4 mt-lg-5 pt-lg-5">
                            <div class="bg-white rounded-2 p-4 wow animated fadeInDown">
                                <h3 class="h4 fw-bold mb-3">Product Description</h3>
                                <div class="product-description">
                                    {!! $product->description !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
