@foreach($products as $product)
    <div class="col-lg-4 col-md-6 col-sm-6 wow animated fadeInDown mt-4">
        <div class="img-box p-4 rounded-2 position-relative bg-white text-center shadow-sm">

            @php
                $isNew = \Carbon\Carbon::parse($product->created_at)->gt(now()->subDays(1));
            @endphp

            @if($isNew)
                <span class="badge bg-blue position-absolute start-0 top-0 mt-3 ms-3">New</span>
            @endif

            @php
                $firstImage = $product->images->first();
                $imageUrl = ($firstImage && $firstImage->type === 'external') ? $firstImage->file : asset('docs/' . ($firstImage->file ?? 'default.jpg'));
            @endphp

            <img src="{{ $imageUrl }}" alt="Product" class="img-fluid object-fit-contain transition" />
            <div class="position-absolute end-0 bottom-0 me-3 mb-3 hover-btns transition">
                <button class="btn btn-sm my-1 bg-white openProductDetailModal"
                        data-bs-toggle="modal"
                        data-bs-target="#productModal"
                        data-name="{{ $product->name }}"
                        data-image="{{ $imageUrl }}"
                        data-old-price="{{ $product->discount_price }}"
                        data-new-price="{{ $product->price }}"
                        data-supplier="{{ $product->supplier->first_name . ' ' . $product->supplier->last_name }}"
                        data-description="{{ $product->description }}">
                    <i class="fa fa-eye"></i>
                </button>


                <div class="clearfix"></div>
                <button class="btn btn-sm my-1 bg-white addToCartBtn"><i class="fa fa-cart-plus"></i></button>
                <div class="clearfix"></div>


            </div>
        </div>
        <div class="d-flex flex-column gap-3 mt-4">
            <input type="hidden" class="productId" value="{{$product->id}}">
            <span class="opacity-50 wow animated fadeInDown">{{$product->category->name ?? ''}}</span>
            <a href="{{route('product.details',$product->id)}}" class="lh-125 fw-bold wow animated fadeInDown text-darks text-hover-purple transition">{{$product->name ?? ''}}</a>
            <p class="wow animated fadeInDown text-darks fs-13">Supplier: <span class="text-blue">{{$product->supplier->first_name.' '.$product->supplier->last_name}}</span></p>
            <p class="wow animated fadeInDown text-purple"><del class="opacity-25 text-darks">$125.00</del> -  <b>{{$product->price ?? ''}}</b></p>
        </div>
    </div>
@endforeach
