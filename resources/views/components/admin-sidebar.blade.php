<div class="col-lg-3 col-md-4 my-4">
    <aside class="bg-white py-3 px-3 rounded-2 h-100 shadow-sm wow animated fadeInDown after-login">
        <ul>
            @php
                use Illuminate\Support\Facades\Auth;
                use App\Models\User;

                $route = Auth::user()->type === User::TYPE_SUPPLIER
                    ? route('supplier.profile')
                    : route('buyer.profile');
            @endphp

            <li class="wow animated fadeInDown my-1 active">
                <a href="{{ $route }}" class="p-3 transition rounded-2 d-flex gap-3 align-items-center">
                    <i class="fa fa-user-tie"></i> Profile
                </a>
            </li>

            <li class="wow animated fadeInDown my-1">
                <a href="{{route('order.index')}}" class="p-3 transition rounded-2 d-flex gap-3 align-items-center">
                    <i class="fa fa-receipt"></i> Orders
                </a>
            </li>

            @if (Auth::user()->type === User::TYPE_SUPPLIER)
                <li class="wow animated fadeInDown my-1">
                    <a href="{{route('supplier.product')}}" class="p-3 transition rounded-2 d-flex gap-3 align-items-center">
                        <i class="fa fa-box"></i> Products
                    </a>
                </li>
            @endif
        </ul>
    </aside>
</div>
