@extends('front.layouts.layout')
@section('title', "Approval")
@section('content')
    <section class="support py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3 wow animated fadeInDown fw-bold"><i class="fa fa-user me-2"></i> Admin <span class="text-purple">Portal</span></h3>
                </div>
            </div>
            <div class="row align-items-stretch">
              @include('admin.components.sidebar')
                <div class="col-lg-9 col-md-8 my-4 wow animated fadeInDown">
                    <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Approvals</h3>
                            <ul class="nav nav-pills" id="pills-tab" role="tablist">
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <button class="nav-link fs-14 active" id="pills-buyer-tab" data-bs-toggle="pill" data-bs-target="#pills-buyer" type="button" role="tab" aria-controls="pills-buyer" aria-selected="true">Buyer</button>--}}
{{--                                </li>--}}
{{--                                <li class="nav-item" role="presentation">--}}
{{--                                    <button class="nav-link fs-14" id="pills-supplier-tab" data-bs-toggle="pill" data-bs-target="#pills-supplier" type="button" role="tab" aria-controls="pills-supplier" aria-selected="false">Supplier</button>--}}
{{--                                </li>--}}
                            </ul>
                        </div>
                        <hr />
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show " id="pills-buyer" role="tabpanel" aria-labelledby="pills-buyer-tab" tabindex="0">
                                <div class="table-responsive my-3">
                                    <table class="table table-striped table-border">
                                        <thead>
                                        <tr>
                                            <th class="p-3 fs-14 bg-blue text-white">Company Name <a href="javascript:;" class="text-blue"><i class="fa fa-caret-down ms-1"></i></a></th>
                                            <th class="p-3 fs-14 bg-blue text-white">Registration Number</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Email</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Profile Status</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($company as $com)
                                            <tr>
                                                <td class="p-3 fs-13">{{$com->name}}</td>
                                                <td class="p-3 fs-13">{{$com->registration_number}}</td>
                                                @if($com->supplier)
                                                    <td class="p-3 fs-13">{{$com->supplier->email}}</td>
                                                    <td class="p-3 fs-13">{{$com->supplier->status}}</td>
                                                @elseif($com->buyer)
                                                    <td class="p-3 fs-13">{{$com->buyer->email}}</td>
                                                    <td class="p-3 fs-13">{{$com->buyer->status}}</td>
                                                @endif

                                                <td class="p-3 fs-13 d-flex gap-2">
                                                    <a href="{{route('view.profile',$com->user_id)}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i></a>
{{--                                                    <a href="javascript:;" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>--}}
                                                    <form action="{{ route('user.delete', $com->user_id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>


                                                    <button data-url="{{ route('update.status', ['userId' => $com->user_id, 'status' => 'active']) }}" class=" update-status-btn btn btn-outline-success btn-sm"><i class="fa fa-check"></i></button>
                                                    <button data-url="{{ route('update.status', ['userId' => $com->user_id, 'status' => 'declined']) }}" class=" update-status-btn btn btn-outline-warning btn-sm"><i class="fa fa-times"></i></button></td>
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
                            <div class="tab-pane fade show active" id="pills-supplier" role="tabpanel" aria-labelledby="pills-supplier-tab" tabindex="0">
                                <div class="table-responsive my-3">
                                    <table class="table table-striped table-border">
                                        <thead>
                                        <tr>
                                            <th class="p-3 fs-14 bg-blue text-white">Company Name <a href="javascript:;" class="text-blue"><i class="fa fa-caret-down ms-1"></i></a></th>
                                            <th class="p-3 fs-14 bg-blue text-white">Registration Number</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Email</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Profile Status</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Profile</th>
                                            <th class="p-3 fs-14 bg-blue text-white">Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($company as $com)
                                            <tr>
                                                <td class="p-3 fs-13">{{$com->name}}</td>
                                                <td class="p-3 fs-13">{{$com->registration_number}}</td>
                                                @if($com->supplier)
                                                    <td class="p-3 fs-13">{{$com->supplier->email}}</td>
                                                    <td class="p-3 fs-13">{{$com->supplier->status}}</td>
                                                    <td>
                                                        <span class="badge bg-blue p-2 text-white rounded">Supplier</span>
                                                    </td>
                                                @elseif($com->buyer)
                                                    <td class="p-3 fs-13">{{$com->buyer->email}}</td>
                                                    <td class="p-3 fs-13">{{$com->buyer->status}}</td>
                                                    <td>
                                                        <span class="badge bg-blue p-2 text-white rounded">Buyer</span>
                                                    </td>
                                                @endif
                                                <td class="p-3 fs-13 d-flex gap-2">
                                                    <a href="{{route('view.profile',$com->user_id)}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-eye"></i></a>
                                                    {{--                                                    <a href="javascript:;" class="btn btn-outline-danger btn-sm"><i class="fa fa-trash"></i></a>--}}
                                                    <form action="{{ route('user.delete', $com->user_id) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-outline-danger btn-sm">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>


                                                    <button data-url="{{ route('update.status', ['userId' => $com->user_id, 'status' => 'active']) }}" class=" update-status-btn btn btn-outline-success btn-sm"><i class="fa fa-check"></i></button>
                                                    <button data-url="{{ route('update.status', ['userId' => $com->user_id, 'status' => 'declined']) }}" class=" update-status-btn btn btn-outline-warning btn-sm"><i class="fa fa-times"></i></button></td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>
                                <nav aria-label="Page navigation example" class="mt-5 mb-4 wow animated fadeInDown pag">
                                    <ul class="pagination justify-content-center">
                                        {{-- Previous Page Link --}}
                                        @if ($company->onFirstPage())
                                            <li class="page-item disabled">
                                                <span class="page-link p-3 fs-13"><i class="fa fa-angle-left"></i></span>
                                            </li>
                                        @else
                                            <li class="page-item">
                                                <a class="page-link p-3 fs-13" href="{{ $company->previousPageUrl() }}">
                                                    <i class="fa fa-angle-left"></i>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @foreach ($company->links()->elements[0] as $page => $url)
                                            <li class="page-item {{ $company->currentPage() == $page ? 'active bg-blue' : '' }}">
                                                <a class="page-link p-3 fs-13" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                        @endforeach

                                        {{-- Next Page Link --}}
                                        @if ($company->hasMorePages())
                                            <li class="page-item">
                                                <a class="page-link p-3 fs-13" href="{{ $company->nextPageUrl() }}">
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
            </div>
    </section>

@endsection
