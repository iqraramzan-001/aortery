@extends('front.layouts.layout')
@section('title', "Supplier Profile")

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
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Activity Log</h3>
                        </div>
                        <hr />
                        <div class="table-responsive my-3">
                            <table class="table table-striped table-border">
                                <thead>
                                <tr>
                                    <th class="p-3 fs-14 bg-blue text-white">Account Type <a href="javascript:;" class="text-blue"><i class="fa fa-caret-down ms-1"></i></a></th>
                                    <th class="p-3 fs-14 bg-blue text-white">Company Name</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Activity</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Dat &amp; Time <a href="javascript:;" class="text-blue"><i class="fa fa-caret-down ms-1"></i></a></th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
                                <tr>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                    <td class="p-3 fs-13">Columns Item</td>
                                </tr>
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
@endsection
