@if($products && count($products) > 0)
@foreach($products as $product)
    @php
        $firstImage = $product->images->first();
        $imageUrl = ($firstImage && $firstImage->type === 'external') ? $firstImage->file : asset('docs/' . ($firstImage->file ?? 'default.jpg'));
    @endphp
    <div class="col-lg-4 col-md-6 col-sm-6 wow animated fadeInDown mt-4">
        <div class="img-box p-4 rounded-2 position-relative bg-white text-center shadow-sm">
            @php
                $isNew = \Carbon\Carbon::parse($product->created_at)->gt(now()->subDays(2));
            @endphp

            @if($isNew)
                <span class="badge bg-blue position-absolute start-0 top-0 mt-3 ms-3">New</span>
            @endif

            <img src="{{ $imageUrl }}" alt="Product" class="img-fluid object-fit-contain transition" />
            <div class="position-absolute end-0 bottom-0 me-3 mb-3 hover-btns transition">
                <a href="javascript:;" class="btn btn-sm my-1 bg-white" data-bs-toggle="modal" data-bs-target="#productModal"><i class="fa fa-eye"></i></a>
                <div class="clearfix"></div>
                <button class="btn btn-sm my-1 bg-white addToCartBtn"><i class="fa fa-cart-plus"></i></button>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-6 wow animated fadeInDown  mt-4">
        <div class="d-flex flex-column gap-3">
            <input type="hidden" class="productId" value="{{$product->id}}">
            <span class="opacity-50 wow animated fadeInDown">{{$product->category->name}}</span>
            <a href="{{route('product.details',$product->id)}}" class="lh-125 fw-bold wow animated fadeInDown text-darks text-hover-purple transition">{{$product->name}}</a>
            <p class="wow animated fadeInDown lh-150 d-none d-lg-block product-description">{!! Str::words(strip_tags($product->description), 60, '...') !!}</p>

            <p class="wow animated fadeInDown text-darks fs-13">Supplier: <span class="text-blue">{{$product->supplier->first_name.' '.$product->supplier->last_name}}</span></p>
            <p class="wow animated fadeInDown text-purple"><del class="opacity-25 text-darks">$125.00</del> -  <b>{{$product->price}}</b></p>
        </div>
    </div>
@endforeach
@else
    <p class="no-products">No products.</p>
@endif
