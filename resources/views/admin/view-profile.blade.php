@extends('front.layouts.layout')
@section('title',"View Profile")
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
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Profile</h3>
                            <div class="d-flex gap-3 align-items-center">
                                <button data-url="{{ route('update.status', ['userId' => $company->user_id, 'status' => 'active']) }}" name="btn" class="update-status-btn btn btn-success btn-sm pb-0"><i class="fa fa-check"></i></button>
                                <button data-url="{{ route('update.status', ['userId' => $company->user_id, 'status' => 'decline']) }}" name="btn" class="update-status-btn btn btn-danger btn-sm pb-0"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Med Kit" value="{{$company->name}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Company Address</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 466 North Street, Illigford, East London" value="{{$company->address}}" />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mt-2 wow animated fadeInDown align-items-center d-flex justify-content-between">
                                    <label class="form-label fw-bold">Warehouse Location</label>
                                    <a class="btn btn-purple rounded-pill btn-sm px-3"><i class="fa fa-plus me-1"></i>Add Another</a>
                                </div>
                            </div>
                        </div>
                        <div class="bg-light border rounded-2 py-2 px-4 mt-4 mb-2">
                            <div class="row aling-items-stretch">
                                @php
                                $warehouse=$company->warehouses->first();
                                 @endphp
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Warehouse Name</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: XYZ PVT LTD" value="{{$warehouse->name ?? ''}}" />
                                    </div>
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Open From</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 09:00 AM" value="{{$warehouse->open_from ?? ' '}}"/>
                                    </div>
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Open To</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 06:00 PM" value="{{$warehouse->open_to ?? ''}}" />
                                    </div>
                                    <div class="my-4 wow animated fadeInDown">
                                        <form action="{{ route('delete.warehouse', $warehouse->id ?? '') }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100 p-2"><i class="fa fa-trash-alt me-1"></i> Delete Warehouse</button>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">

                                        <iframe width="100%" height="330" id="gmap_canvas" class="rounded-2 shadow-sm mt-1 border" src="{{$warehouse->location ?? ''}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row aling-items-stretch">
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Registration Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 213654789" value="{{$company->registration_number}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Unified Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 789654" value="{{$company->unified_number}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label">Commercial Registration Document</label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Example: 789654" />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Uploaded Documents</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($company->documents->where('type', 'registration') as $doc)
                                            <a href="javascript:;" class="btn btn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill">
                                                <i class="fa fa-file-pdf text-purple"></i> {{$doc->file}}
                                                <i class="fa fa-times text-danger ms-1"></i>
                                            </a>
                                        @endforeach



                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Registration Expiration Date</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 213654789" value="{{$company->reg_expiry_date}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">VAT Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 789654" value="{{$company->vat_number}}"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label">VAT Certificate</label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Example: 789654" />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Uploaded Documents</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach($company->documents->where('type', 'certificate') as $doc)
                                            <a href="javascript:;" class="btn btn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill">
                                                <i class="fa fa-file-pdf text-purple"></i> {{$doc->file}}
                                                <i class="fa fa-times text-danger ms-1"></i>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Account Manager First Name</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: John" value="{{$userData->first_name}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Account Manager First Name</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Doe" value="{{$userData->last_name}}" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: johndoe@test.com" value="{{$userData->email}}"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: +44132456879" value="{{$userData->phone}}"/>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label d-flex justify-content-between">Authorization Letter <a href="javascript:;" class="text-purple fs-12 fw-bold"><i class="fa fa-download"></i> Download Template</a></label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Example: 789654" />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Uploaded Documents</label>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="javascript:;" class="btn tbn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill"><i class="fa fa-file-pdf text-purple"></i> Filename.pdf <i class="fa fa-times text-danger ms-1"></i></a>
                                        <a href="javascript:;" class="btn tbn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill"><i class="fa fa-file-pdf text-purple"></i> Filename2.pdf <i class="fa fa-times text-danger ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Notes</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Details notes..." />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown d-flex gap-3">
                                    <button name="btn" class="btn btn-blue p-3 px-5 rounded-pill">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

@endsection
