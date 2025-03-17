@extends('front.layouts.layout')
@section('title', 'Products')
@section('content')
    <div class="overlay position-fixed top-0 end-0 start-0 bottom-0 transition">
        <div class="container position-relative">
            <a href="javascript:;" class="position-absolute end-0 timess btn btn-danger btn-sm px-1 py-0 rounde-circle fs-13"><i class="fa fa-times"></i></a>
            <section class="bg-white rounded-2 overflow-hidden">
                <div class="row align-items-stretch">
                    <div class="col-lg-3 col-md-4">
                        <ul class="main-cats py-2 border-end bg-light h-100">
                            @foreach($categories as $category)
                                <li>
                                    <a href="javascript:;"
                                       class="d-flex justify-content-between p-3 fs-14 transition main-category"
                                       data-category-id="{{ $category->id }}">
                                        {{ $category->name }}
                                        @if($category->children->isNotEmpty())
                                            <i class="fa fa-angle-right"></i>
                                        @endif
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-9 col-md-8">
                        @foreach($categories as $category)
                            @if($category->children->isNotEmpty())
                                <div class="row py-1 sub-menu" id="sub{{ $category->id }}">
                                    @foreach($category->children as $subCategory)
                                        <div class="col-lg-3 col-md-6 my-3">
                                            <a href="{{ route('product.index', ['category_id' => $subCategory->id])}}" class="h6 fw-bold">{{ $subCategory->name }}</a>
                                            @if($subCategory->children->isNotEmpty())
                                                <ul class="sub-cats">
                                                    @foreach($subCategory->children as $subSubCategory)
                                                        <li>

                                                            <a href="{{ route('product.index', ['category_id' => $subSubCategory->id])}}" class="py-1 d-block fs-13 transition">
                                                                {{ $subSubCategory->name }}
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
    <div class="container">
        <div class="row aling-items-stretch py-md-4">
            @include('product.components.sidebar')
            <div class="col-xl-9 xol-lg-8 col-md-8">
                <div class="h-100">
                    <div class="bg-white rounded-2 shadow-sm px-4 py-1 mt-4 wow animated fadeInRight">
                        <div class="d-lg-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold wow animated fadeInRight my-3 filter title"><a href="javascript:;" class="text-purple"><i class="fa fa-bars me-2"></i></a> All Products</h3>
                            <div class="d-flex gap-2 align-items-center change-view" id="mobile">
                                <input type="radio" class="btn-check" name="options-base1" id="option3" autocomplete="off" checked />
                                <label class="btn btn-sm" for="option3"><i class="fa fa-table"></i></label>

                                <input type="radio" class="btn-check" name="options-base1" id="option4" autocomplete="off" />
                                <label class="btn btn-sm" for="option4"><i class="fa fa-list"></i></label>
                            </div>
                            <div class="d-sm-flex align-items-cneter gap-2 my-3 filters">
{{--                                <form id="searchForm" class="position-relative search-bar w-auto my-0 wow animated fadeInRight" role="search">--}}
{{--                                    <input class="form-control w-100 shadow-none rounded-pill fs-14 searchInput" type="search" placeholder="Search" aria-label="Search"--}}
{{--                                           name="search" id="searchInput" />--}}
{{--                                    <button class="btn btn-light border-0 shadow-none position-absolute start-0 top-0" type="submit">--}}
{{--                                        <i class="fa fa-search"></i>--}}
{{--                                    </button>--}}
{{--                                </form>--}}
                                <form id="searchForm" class="position-relative search-bar w-auto my-0 wow animated fadeInRight" role="search">
                                    <input class="form-control w-100 shadow-none rounded-pill fs-14 searchInput" type="search" placeholder="Search" aria-label="Search" id="searchInput" />
                                    <button class="btn bnt-light border-0 shadow-none position-absolute start-0 top-0" type="submit"><i class="fa fa-search"></i></button>
                                </form>

                                <select  class="form-select rounded-pill fs-14 shadow-none wow animated fadeInRight w-auto" name="filter" id="filterSelect">
                                    <option value="">Filters</option>
                                    <option value="oldest" >By Oldest</option>
                                    <option value="latest" >By Latest</option>
                                    <option value="price_low_high">By Price Low to High</option>
                                    <option value="price_high_low">By Price High to Low</option>
                                </select>
                                <div class="d-flex gap-2 align-items-center change-view" id="desktop">
                                    <input type="radio" class="btn-check view-toggle" name="view" id="gridViewRadio" value="grid" autocomplete="off" checked />
                                    <label class="btn btn-sm" for="gridViewRadio"><i class="fa fa-table"></i></label>

                                    <input type="radio" class="btn-check view-toggle" name="view" id="listViewRadio" value="list" autocomplete="off" />
                                    <label class="btn btn-sm" for="listViewRadio"><i class="fa fa-list"></i></label>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="row align-items-center" style="display:none;" id="list-View">
                        @include('product.partials.list-view')
                    </div>
                    <div class="row align-items-center" id="grid-View">
                           @include('product.partials.grid-view')
                    </div>
                    <nav aria-label="Page navigation example" class="mt-5 mb-4 wow animated fadeInDown pag">
                        <ul class="pagination justify-content-center">
                            {{-- Previous Page Link --}}
                            @if ($products->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link p-3 fs-13"><i class="fa fa-angle-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link p-3 fs-13" href="{{ $products->previousPageUrl() }}">
                                        <i class="fa fa-angle-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Page Numbers --}}
                            @foreach ($products->links()->elements[0] as $page => $url)
                                <li class="page-item {{ $products->currentPage() == $page ? 'active bg-blue' : '' }}">
                                    <a class="page-link p-3 fs-13" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($products->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link p-3 fs-13" href="{{ $products->nextPageUrl() }}">
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </li>
                            @else
                                <li class="page-item disabled">
                                    <span class="page-link p-3 fs-13"><i class="fa fa-angle-right"></i></span>
                                </li>
                            @endif
                        </ul>
                    </nav>

                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="productModalLabel"></h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="bg-light h-100 text-center rounded-2 p-4 p-lg-5">
                                <img id="modalProductImage" src="" alt="Product" class="img-fluid object-fit-contain mm-h-350" />
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="h-100">
                                <span class="text-purple fs-5 d-block mt-4"><del id="modalOldPrice" class="opacity-25 text-darks">$125.00</del> -  <b id="modalNewPrice">$100.00</b></span>

                                <p class="text-darks fs-14 mt-4">Supplier: <span class="text-blue" id="modalSupplier"></span></p>
                                <p class="lh-150 pt-4 pb-2" id="modalDescription"></p>
                                <div class="d-sm-flex gap-3 align-items-center">
                                    <div id="field1" class="d-flex gap-2 align-items-center my-3">
                                        <button type="button" class="sub btn btn-sm btn-blue " data-id="1"><i class="fa fa-minus"></i></button>
                                        <input type="text" class="quantity-input form-control rounded-pill text-center shadow-none" data-id="1" value="1" min="1" max="999"/>
                                        <button type="button" class="add btn btn-sm btn-blue " data-id="1"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <button class="btn btn-purple px-4 rounded-pill my-3 addToCartBtn" data-id="1">Add To Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
