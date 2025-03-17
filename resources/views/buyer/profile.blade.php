
@extends('front.layouts.layout')
@section('title',"Buyer Profile")
@section('content')
<section class="support py-5">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="h3 wow animated fadeInDown fw-bold"><i class="fa fa-user-tie me-2"></i> Buyer <span class="text-purple">Portal</span></h3>
            </div>
        </div>
        <div class="row align-items-stretch">
            @if(Auth::user()->type==='admin')
                @include('admin.components.sidebar')
            @else
                @include('components.admin-sidebar')
            @endif
            <div class="col-lg-9 col-md-8 my-4 wow animated fadeInDown">
                <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                    <div class="d-flex justify-content-between align-items-center">
                        <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Profile</h3>
                        <div class="d-flex gap-2">
                            <a href="new-password.html" class="text-purple fs-12">Change Password</a>
                            <span class="fs-12">-</span>
                            <a href="buyer-profile.html" class="text-purple fs-12">Edit Profile</a>
                        </div>
                    </div>
                    <hr />
                    <form action="{{route('save.buyer.profile')}}" method="POST" id="profileFormBuyer" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Company Name</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: Med Kit" /
                                    name="name"
                                    value="{{ old('name', $company->name ?? '') }}"
                                    >
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Company Address</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 466 North Street, Illigford, East London"   name="address"
                                           value="{{ old('address', $company->address ?? '') }}"  />
                                </div>
                            </div>
                            <form id="warehoureform">
                                <div class="col-12">
                                    <div class="mt-2 wow animated fadeInDown">
                                        <label class="form-label">Warehouse Location</label>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Warehouse Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: XYZ PVT LTD"  name="house_name"/>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Location</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: Google Map" name="location" />
                                    </div>
                                </div>
                                <div class="col-lg-4 position-relative">
                                    <!-- <a href="javascript:;" class="text-danger position-absolute end-0 me-2 mt-4 wow animated fadeInDown"><i class="fa fa-trash-alt"></i></a> -->
                                    <label class="form-label mt-4">Opening Hours</label>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="mb-4 wow animated fadeInDown">
                                                <input type="time" class="form-control p-3 rounded-pill shadow-none" name="open_from" />
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="mb-4 wow animated fadeInDown">
                                                <input type="time" class="form-control p-3 rounded-pill shadow-none" name="open_to" />
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </form>

                            <div class="col-12">
                                <button  class="btn btn-purple rounded-pill btn-sm px-3"><i class="fa fa-plus me-1"></i>Add Another</button>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Registration Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 213654789" name="register_number" value="{{ old('register_number', $company->registration_number ?? '') }}"  />
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Unified Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 789654" name="unified_number" value="{{ old('unified_number', $company->unified_number ?? '') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label">Commercial Registration Document</label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Ex: 789654" name="register_doc[]" onchange="previewFiles(this, 'register_doc')"  />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Uploaded Documents</label>
                                    <div class="d-flex flex-wrap gap-2" id="fileList-register_doc"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Registration Expiration Date</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 213654789" name="reg_expire_date"
                                           value="{{ old('register_number', $company->registration_number ?? '') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">VAT Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 789654" name="vat_number"
                                           value="{{ old('vat_number', $company->vat_number ?? '') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label">VAT Certificate</label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Ex: 789654" name="certificate[]" onchange="previewFiles(this, 'certificate')"  />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Uploaded Documents</label>
                                    <div class="d-flex flex-wrap gap-2" id="fileList-certificate"></div>

                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Account Manager First Name</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: John" name="first_name"
                                           value="{{ old('first_name', $buyer->first_name ?? '') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Account Manager Last Name</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: John" name="last_name"
                                           value="{{ old('last_name', $buyer->last_name ?? '') }}"/>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: johndoe@test.com" name="email"   value="{{ old('email', $buyer->email ?? '') }}"/>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: +44132456879"  name="phone" value="{{ old('phone', $buyer->phone ?? '') }}"/>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label d-flex justify-content-between">Authorization Letter <a href="javascript:;" class="text-purple fs-12 fw-bold"><i class="fa fa-download"></i> Download Template</a></label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Ex: 789654"  name="letters[]" onchange="previewFiles(this, 'letters')" />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <label class="form-label">Uploaded Documents</label>
                                    <div class="d-flex flex-wrap gap-2" id="fileList-letters"></div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <button   type="button" class="btn btn-blue p-3 px-5 rounded-pill"  id="confirmSubmit">Submit Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
</section>
<div class="modal fade " id="confirmationModalBuyer" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="confirmationModalLabel">Confirmation</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="alert alert-warning mb-0 fs-14 lh-150 d-flex gap-3 align-items-start">
                    <i class="fa fa-triangle-exclamation mt-1 fa-2x"></i> The profile will go through a review process.<br />Please double-check all information is accurate before submitting.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-dark px-4 rounded-pill" data-bs-dismiss="modal">Review</button>
                <button type="button" class="btn btn-blue px-4 rounded-pill"   id="confirmModalSubmit">Submit</button>

            </div>
        </div>
    </div>
</div>
<!-- Success Modal -->
<div class="modal fade" id="successModalBuyer" tabindex="-1" aria-labelledby="succcessModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="succcessModalLabel">Success</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                <i class="fa fa-check-circle fa-3x text-success"></i>
                <strong class="fs-5 text-success d-block my-4">Submitted</strong>
                <div class="alert alert-warning fs-14 lh-150 d-flex gap-3 align-items-start">Profile is currently under review...</div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>

    $(document).ready(function () {
        $('#confirmSubmit').on('click', function () {
            console.log("inside jssdsd")
            $('#confirmationModalBuyer').modal('show');

        });

        $('#confirmModalSubmit').on('click', function (e) {
            $('#confirmationModalBuyer').modal('hide');
            e.preventDefault();
            console.log("inside form submit");
            var formData = new FormData($('#profileFormBuyer')[0]);
            $.ajax({
                url: $('#profileFormBuyer').attr('action'),
                type: $('#profileFormBuyer').attr('method'),
                data: formData,
                processData: false,  // FormData use karne ke liye false rakhein
                contentType: false,  // File upload ke liye content type ko false rakhein
                success: function (response) {

                    $('#successModalBuyer').modal('show');
                },
                error: function (xhr, status, error) {
                    console.log("Form submission error:", error);
                }
            });
        });

    });
</script>

<script>
    let selectedFiles = {
        certificate: [],
        letters: [],
        register_doc: []
    };

    function previewFiles(input, category) {
        // Append new files to the selected category array
        Array.from(input.files).forEach((file) => {
            selectedFiles[category].push(file);
        });

        updateFileList(category);
    }

    function updateFileList(category) {
        const fileList = document.getElementById(`fileList-${category}`);
        fileList.innerHTML = "";

        selectedFiles[category].forEach((file, index) => {
            const fileType = file.name.endsWith(".pdf") ? "file-pdf" : "file-alt"; // Adjust icon if needed
            const fileName = file.name;

            const fileElement = document.createElement("a");
            fileElement.href = "javascript:;";
            fileElement.className = "btn btn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill";
            fileElement.innerHTML = `
                <i class="fa fa-${fileType} text-purple"></i> ${fileName}
                <i class="fa fa-times text-danger ms-1" onclick="removeFile('${category}', ${index})"></i>
            `;

            fileList.appendChild(fileElement);
        });

        updateFileInput(category);
    }

    function removeFile(category, index) {
        selectedFiles[category].splice(index, 1);
        updateFileList(category);
    }

    function updateFileInput(category) {
        const fileInput = document.querySelector(`input[name="${category}[]"]`);
        const dataTransfer = new DataTransfer();

        selectedFiles[category].forEach((file) => dataTransfer.items.add(file));

        fileInput.files = dataTransfer.files;
    }
</script>





@endsection
