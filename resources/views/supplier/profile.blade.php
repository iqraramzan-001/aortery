@extends('front.layouts.layout')
@section('title',"Supplier Profile")

@section('content')
    <section class="support py-5">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="h3 wow animated fadeInDown fw-bold"><i class="fa fa-shop me-2"></i> Supplier <span class="text-purple">Portal</span></h3>
                </div>
            </div>

            <div class="row align-items-stretch">
                @include('components.admin-sidebar')

                <div class="col-lg-9 col-md-8 my-4 wow animated fadeInDown">
                    <div class="bg-white rounded-2 p-4 shadow-sm animated wow fadeInDown h-100">
                        @if(Auth::user()->type=='supplier')
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Profile</h3>
                            <div class="d-flex gap-2">
                                <a href="new-password.html" class="text-purple fs-12">Change Password</a>
                                <span class="fs-12">-</span>
                                <a href="supplier-profile.html" class="text-purple fs-12">Edit Profile</a>
                            </div>
                        </div>
                        @endif
                        @if(Auth::user()->type=='admin')
                            <div class="d-flex justify-content-between align-items-center">
                                <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Profile</h3>
                                <div class="d-flex gap-3 align-items-center">
                                    <button data-url="{{ route('update.status', ['userId' => $company->user_id, 'status' => 'active']) }}" name="btn" class="update-status-btn btn btn-success btn-sm pb-0"><i class="fa fa-check"></i></button>
                                    <button data-url="{{ route('update.status', ['userId' => $company->user_id, 'status' => 'decline']) }}" name="btn" class="update-status-btn btn btn-danger btn-sm pb-0"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                        @endif

                        <hr />
                        <form action="{{route('save.supplier.profile')}}" method="POST" id="profileForm" enctype="multipart/form-data">
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

                                    <div class="col-12">
                                        <div class="mt-2 wow animated fadeInDown">
                                            <label class="form-label">Warehouse Location</label>
                                        </div>
                                    </div>
                                    <div class="row warehouseRow" >
                                        <div class="col-lg-4">
                                            <div class="my-4 wow animated fadeInDown">
                                                <label class="form-label">Warehouse Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: XYZ PVT LTD" name="house_name"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-4 wow animated fadeInDown">
                                                <label class="form-label">Location</label>
                                                <input type="text" class="form-control p-3 rounded-pill shadow-none locationInput" placeholder="Click to Select Location" readonly />
                                                <input type="hidden" class="latitude" name="latitude" />
                                                <input type="hidden" class="longitude" name="longitude" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 position-relative">
                                            <!-- <a href="javascript:;" class="text-danger position-absolute end-0 me-2 mt-4 wow animated fadeInDown"><i class="fa fa-trash-alt"></i></a> -->
                                            <label class="form-label mt-4">Opening Hours</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-4 wow animated fadeInDown">
                                                        <input type="time" class="form-control p-3 rounded-pill shadow-none" placeholder="09:00 AM" name="open_from" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-4 wow animated fadeInDown">
                                                        <input type="time" class="form-control p-3 rounded-pill shadow-none" placeholder="06:00 PM" name="open_to" />
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                <div class="col-12">
                                    <button id="wareHouseBtn" type="button"  class="btn btn-purple rounded-pill btn-sm px-3"><i class="fa fa-plus me-1"></i>Add Another</button>
                                </div>
                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Registration Number</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 213654789" name="register_number"
                                               value="{{ old('register_number', $company->registration_number ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Unified Number</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: 789654" name="unified_number"
                                               value="{{ old('unified_number', $company->unified_number ?? '') }}"/>
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
                                               value="{{ old('reg_expire_date', $company->reg_expire_date ?? '') }}"/>
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
                                               value="{{ old('first_name', $supplier->first_name ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Account Manager Last Name</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: Doe" name="last_name"
                                               value="{{ old('last_name', $supplier->last_name ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: johndoe@test.com" name="email"
                                               value="{{ old('email', $supplier->email ?? '') }}"/>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Phone Number</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: +44132456879"  name="phone"
                                               value="{{ old('phone', $supplier->phone ?? '') }}"/>
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
                                        <button   type="button" class="btn btn-blue p-3 px-5 rounded-pill"  id="supplierBtn">Submit Profile</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>

                </div>
            </div>
    </section>


    <div class="locationModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pick a Location</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" id="saveLocationBtn" class="btn btn-primary">Save Location</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
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
                    <button type="button" class="btn btn-blue px-4 rounded-pill" id="confirmModalSupplier">Submit</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Success Modal -->
    <div class="modal fade" id="succcesModal" tabindex="-1" aria-labelledby="succcessModalLabel" aria-hidden="true">
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


            $("#wareHouseBtn").click(function (e) {
                e.preventDefault();
                console.log("WAREHOUSE button clicked");

                // Clone the last warehouse row
                let newRow = $(".warehouseRow").last().clone();

                // Generate a unique ID for this new row
                let uniqueId = new Date().getTime();

                // Update input fields to ensure uniqueness
                newRow.find("input").each(function () {
                    let name = $(this).attr("name");
                    $(this).attr("name", name + "_" + uniqueId); // Ensure unique names
                    $(this).val(""); // Clear input values
                });

                // Append the new row below the last one
                $(".warehouseRow").last().after(newRow);
            });


            let selectedInput = null;
            let map, marker;

            function initMap() {
                map = new google.maps.Map(document.getElementById("map"), {
                    center: { lat: 31.5204, lng: 74.3587 }, // Default location (Lahore)
                    zoom: 10,
                });

                marker = new google.maps.Marker({
                    position: { lat: 31.5204, lng: 74.3587 },
                    map: map,
                    draggable: true,
                });

                google.maps.event.addListener(marker, "dragend", function () {
                    let position = marker.getPosition();
                    console.log("Lat: " + position.lat() + ", Lng: " + position.lng());
                });
            }

// Open Modal & Load Google Maps
            $(document).on("click", ".locationInput", function () {
                selectedInput = $(this);
                $(".locationModal").modal("show");

                setTimeout(() => {
                    google.maps.event.trigger(map, "resize");
                    let defaultLat = parseFloat(selectedInput.siblings(".latitude").val()) || 31.5204;
                    let defaultLng = parseFloat(selectedInput.siblings(".longitude").val()) || 74.3587;
                    map.setCenter({ lat: defaultLat, lng: defaultLng });
                    marker.setPosition({ lat: defaultLat, lng: defaultLng });
                }, 500);
            });

// Save Selected Location
            $("#saveLocationBtn").click(function () {
                let position = marker.getPosition();
                let lat = position.lat();
                let lng = position.lng();

                if (selectedInput) {
                    selectedInput.val(`Lat: ${lat}, Lng: ${lng}`);
                    selectedInput.siblings(".latitude").val(lat);
                    selectedInput.siblings(".longitude").val(lng);
                }

                $(".locationModal").modal("hide");
            });


            $('#supplierBtn').on('click', function () {
                $('#confirmationModal').modal('show');
            });

            $('#confirmModalSupplier').on('click', function (e) {
                $('#confirmationModal').modal('hide');
                e.preventDefault();

                var formData = new FormData($('#profileForm')[0]);

                $.ajax({
                    url: $('#profileForm').attr('action'),
                    type: $('#profileForm').attr('method'),
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (response) {
                        $('#succcesModal').modal('show'); // Fixed ID mismatch
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
