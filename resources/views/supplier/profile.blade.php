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
                @if(Auth::user()->type==='admin')
                    @include('admin.components.sidebar')
                @else
                @include('components.admin-sidebar')
                @endif

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
                                @foreach($company->warehouses as $house)
                                    <div class="row warehouseRow"  id="row-{{$house->id}}">
                                        <div class="col-lg-4">
                                            <div class="my-4 wow animated fadeInDown">
                                                <label class="form-label">Warehouse Name <span class="text-danger">*</span></label>
                                                <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Ex: XYZ PVT LTD" name="house_name[]" value="{{$house->name}}"/>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="my-4 wow animated fadeInDown">
                                                <label class="form-label">Location</label>
                                                <input type="text" class="form-control p-3 rounded-pill shadow-none locationInput" placeholder="@ google map" readonly />
                                                <input type="hidden" class="houseId" name="id[]" value="{{$house->id}}" />
                                                <input type="hidden" class="latitude" name="latitude[]" value="{{$house->latitude}}" />
                                                <input type="hidden" class="longitude" name="longitude[]" value="{{$house->longitude}}" />
                                                <input type="hidden" class="location" name="location[]" value="{{$house->location}}"   />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 position-relative">
                                            <!-- <a href="javascript:;" class="text-danger position-absolute end-0 me-2 mt-4 wow animated fadeInDown"><i class="fa fa-trash-alt"></i></a> -->
                                            <label class="form-label mt-4">Opening Hours</label>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="mb-4 wow animated fadeInDown">
                                                        <input type="time" class="form-control p-3 rounded-pill shadow-none" placeholder="09:00 AM" name="open_from[]" value="{{$house->open_from}}" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="mb-4 wow animated fadeInDown d-flex">
                                                        <input type="time" class="form-control p-3 rounded-pill shadow-none" placeholder="06:00 PM" name="open_to[]" value="{{$house->open_to}}" />
                                                        <button type="button" class="btn btn-outline-danger w-100 p-2 delete-warehouse" data-id="{{$house->id}}"><i class="fa fa-trash-alt me-1"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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


    <div class="locationModal modal fade"  tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Pick a Location</h5>
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
                </div>
                <div class="modal-body">
{{--                    <input id="autocomplete" class="form-control mb-2" type="text" placeholder="Search a location...">--}}

{{--                    <p class="mt-2"><strong>Coordinates:</strong> <span class="info">N/A</span></p>--}}

                    <div id="map" style="width: 100%; height: 400px;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary saveLocationBtn" data-dismiss="modal">Close</button>
                    <button type="button"  class="btn btn-primary saveLocationBtn">Save Location</button>
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
        let currentRow = null;
        let map, marker;

        window.initMap = function () {
            const defaultPosition = { lat: 37.7749, lng: -122.4194 }; // San Francisco


            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 12,
                center: defaultPosition
            });


            marker = new google.maps.Marker({
                position: defaultPosition,
                map: map,
                draggable: true
            });


            autocomplete = new google.maps.places.Autocomplete(document.getElementById('autocomplete'));
            autocomplete.bindTo('bounds', map);


            autocomplete.addListener('place_changed', function () {
                const place = autocomplete.getPlace();
                if (!place.geometry) return;

                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);
                updateCoordinates(place.geometry.location);
            });

            // Update coordinates when marker is dragged
            marker.addListener('dragend', function (event) {
                updateCoordinates(event.latLng);
            });

            // Initialize Geocoder
            geocoder = new google.maps.Geocoder();


            function updateCoordinates(location) {
                if (currentRow) {
                    let lat = location.lat();
                    let lng = location.lng();
                    currentRow.find(".latitude").val(location.lat());
                    currentRow.find(".longitude").val(location.lng());
                    // currentRow.find(".locationInput").val(`Lat: ${location.lat()}, Lng: ${location.lng()}`);
                    getAddress(lat, lng);
                }
            }
            // // Function to update coordinates
            // function updateCoordinates(location) {
            //     const lat = location.lat();
            //     const lng = location.lng();
            //     getAddress(lat, lng);
            //     $(".info").text(`${lat}, ${lng}`);
            //
            //     console.log("New Coordinates:", lat, lng);
            // }


            function getAddress(lat, lng) {
                const latLng = { lat: lat, lng: lng };

                geocoder.geocode({ location: latLng }, function (results, status) {
                    if (status === "OK") {
                        if (results[0]) {
                            const address = results[0].formatted_address;
                            console.log("Address",address)
                            console.log("Lat",lat)
                            console.log("Loni",lng)


                            // ✅ Setting the address correctly
                            currentRow.find(".location").val(address);
                            // currentRow.find(".locationInput").val(address);



                        }
                    } else {
                        console.log("Geocoder failed due to: " + status);
                    }
                });
            }
        };
    </script>




    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDQxDtoDoP_al1kFRr5txQZz4pL9fIacqw&libraries=places&callback=initMap" async defer></script>


    <script>


        $(document).ready(function () {
            $("#wareHouseBtn").click(function (e) {
                e.preventDefault();
                console.log("WAREHOUSE button clicked");

                let newRow = $(".warehouseRow").last().clone();
                newRow.find("input").val(""); // Clear input values
                let uniqueId = new Date().getTime();
                newRow.find("input").each(function () {
                    let name = $(this).attr("name");
                    $(this).attr("name", name + "_" + uniqueId);
                    $(this).val("");
                });

                $(".warehouseRow").last().after(newRow);
            });






            $(document).on("click", ".locationInput", function () {
                console.log("LocationInput clci");
                currentRow = $(this).closest(".warehouseRow");
                console.log("Current Row",currentRow);

                let lat = parseFloat(currentRow.find(".latitude").val()) || 37.7749;
                let lng = parseFloat(currentRow.find(".longitude").val()) || -122.4194;
console.log("Lat.................",lat);
console.log("lON...................",lng)
                let position = { lat: lat, lng: lng };

                map.setCenter(position);
                marker.setPosition(position);

                $(".locationModal").modal("show");

            });



            $(".saveLocationBtn").click(function () {
                $(".locationModal").modal("hide");
            });


            $('#supplierBtn').on('click', function () {
                $('#confirmationModal').modal('show');
            });

            $('#confirmModalSupplier').on('click', function (e) {
                $('#confirmationModal').modal('hide');
                e.preventDefault();

                let warehouses = [];
                $(".warehouseRow").each(function () {
                    let warehouseData = {
                        name: $(this).find("[name^='house_name']").val(),
                        latitude: $(this).find(".latitude").val(),
                        longitude: $(this).find(".longitude").val(),
                        open_from: $(this).find("[name^='open_from']").val(),
                        open_to: $(this).find("[name^='open_to']").val(),
                        location:$(this).find(".location").val(),
                    };
                    warehouses.push(warehouseData);
                });

                var formData = new FormData($('#profileForm')[0]);
                formData.append("warehouses", JSON.stringify(warehouses));

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

            $(document).on("click", ".delete-warehouse", function () {
                let warehouseId = $(this).data("id");
                console.log("Deleting: #row-" + warehouseId); // Debugging

                Swal.fire({
                    title: "Are you sure?",
                    text: "You won't be able to revert this!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, delete it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('delete.warehouse', ':id') }}".replace(':id', warehouseId), // Laravel Route
                            type: "DELETE",
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function (response) {
                                let jsonResponse = typeof response === "string" ? JSON.parse(response) : response;

                                if (jsonResponse.status === "success") {
                                    Swal.fire("Deleted!", jsonResponse.message, "success");

                                    $("#row-" + warehouseId).fadeOut(500, function () {
                                        $(this).remove();
                                    });
                                } else {
                                    Swal.fire("Error!", "Something went wrong.", "error");
                                }
                            },

                            error: function () {
                                console.log("AJAX Error:", xhr.responseText);
                                Swal.fire("Error!", "Something went wrong.", "error");
                            }
                        });
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
