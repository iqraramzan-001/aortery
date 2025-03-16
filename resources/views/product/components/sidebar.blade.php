<div class="col-xl-3 xol-lg-4 col-md-4 my-4">
    <aside class="bg-white p-4 h-100 shadow-sm rounded-2 wow animated fadeInLeft">
        <h3 class="h5 fw-bold wow animated fadeInLeft border-bottom pb-4">Shop By Category</h3>
        @foreach($productCategory as $cat)

        @endforeach
        <ul class="sub-cat">
            @foreach($productCategory as $cat)
                <li class="d-block py-2"><a href="{{ route('product.index', ['category_id' => $cat->id])}}" class="fs-13 transition">{{$cat->name}}</a></li>
            @endforeach

        </ul>
        <hr />
        <div class="wrapper">
            <h2 class="h5 fw-bold wow animated fadeInLeft border-bottom pb-4 mt-4">Price Range</h2>
            <div class="price-input">
                <div class="field">
                    <span>Min</span>
                    <input type="number" class="input-min" value="2500">
                </div>
                <div class="separator">-</div>
                <div class="field">
                    <span>Max</span>
                    <input type="number" class="input-max" value="7500">
                </div>
            </div>
            <div class="slider">
                <div class="progress"></div>
            </div>
            <div class="range-input">
                <input type="range" class="range-min" min="0" max="10000" value="2500" step="100">
                <input type="range" class="range-max" min="0" max="10000" value="7500" step="100">
            </div>
        </div>
    </aside>
</div>
