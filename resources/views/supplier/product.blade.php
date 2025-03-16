@extends('front.layouts.layout')

@section('title', "Supplier Product")

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
                        <div class="d-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold animated wow fadeInDown mb-0">Products List</h3>
                            <a href="{{route('product.create')}}" class="btn btn-purple btn-sm rounded-pill px-3"><i class="fa fa-plus me-1"></i> Product</a>
                        </div>
                        <hr />
                        <div class="d-lg-flex justify-content-between">
                            <form class="position-relative search-bar my-3" role="search">
                                <input  id="search_name" class="form-control w-100 shadow-none rounded-pill" type="search" name="search" placeholder="Search your products" aria-label="Search" />
                                <button class="btn bnt-light border-0 shadow-none position-absolute start-0 top-0" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                            <div class="d-flex gap-3 align-items-center">
                                <select name="sort" class="form-select rounded-pill fs-14 shadow-none w-auto">
                                    <option>Filters</option>
                                    <option value="latest">By Latest</option>
                                    <option value="oldest">By Oldest</option>
                                    <option value="price_low_high">By Price Low to High</option>
                                    <option value="price_high_low" >By Price High to Low</option>
                                </select>
                                <div class="d-flex align-items-center gap-2">
                                    <small class="fs-12">Show</small>
                                    <select class="form-select rounded-pill fs-14 shadow-none w-auto">
                                        <option>50</option>
                                        <option>100</option>
                                        <option>150</option>
                                        <option>200</option>
                                        <option>250</option>
                                        <option>300</option>
                                        <option>500</option>
                                    </select>
                                    <small class="fs-12">Per Page</small>
                                </div>
                            </div>
                        </div>
{{--                        <div class="table-responsive my-3">--}}
{{--                            <table class="table table-striped table-border">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Product Preview</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">SKU</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Product Name</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Manufacturer</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Country</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Model No.</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">MDMA / GHTF No.</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Classification</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Dimensions (WxLxH)</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Product Warehouse</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Price(SAR)</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Category</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Sub Category</th>--}}
{{--                                    <th class="p-3 fs-14 bg-blue text-white">Sub Sub Category</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}
{{--                                <tbody>--}}
{{--                                @foreach($products as $product)--}}
{{--                                    <tr>--}}
{{--                                        <td class="p-3 fs-13">--}}
{{--                                            <a href="javascript:;" class="btn btn-sm btn-outline-dark"><i class="fa fa-pencil"></i></a>--}}
{{--                                            <button id="imageUploadModalBtn" class="btn btn-sm btn-outline-dark imageUploadModalBtn" data-id="{{$product->id}}"><i class="fa fa-arrow-up"></i></button>--}}
{{--                                        </td>--}}

{{--                                        <div class="clearfix"></div>--}}
{{--                                        <td class="p-3 fs-13">{{$product->sku ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->name ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->manufacturer ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->country ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->model_no ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->mdma_no ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->classification ?? ''}}</td>--}}
{{--                                        <td class="p-3 fs-13">--}}
{{--                                            {{ $product->width && $product->length && $product->height ? "{$product->width} x {$product->length} x {$product->height}" : '' }}--}}
{{--                                        </td>--}}

{{--                                        <td class="p-3 fs-13">Xoft House</td>--}}
{{--                                        <td class="p-3 fs-13">{{$product->price}}</td>--}}
{{--                                        <td class="p-3 fs-13">--}}
{{--                                            {{ $product->category->name ?? '-' }}--}}
{{--                                        </td>--}}
{{--                                        <td class="p-3 fs-13">--}}
{{--                                            {{ $product->subCategory->name ?? '-' }}--}}
{{--                                        </td>--}}
{{--                                        <td class="p-3 fs-13">--}}
{{--                                            {{ $product->subSubCategory->name ?? '-' }}--}}
{{--                                        </td>--}}
{{--                                    </tr>--}}

{{--                                @endforeach--}}
{{--                                </tbody>--}}
{{--                            </table>--}}
{{--                        </div>--}}
                        <div class="table-responsive my-3">
                            <table class="table table-striped table-border" id="product-table">
                                <thead>
                                <tr>
                                    <th class="p-3 fs-14 bg-blue text-white">Product Preview</th>
                                    <th class="p-3 fs-14 bg-blue text-white">SKU</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Product Name</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Manufacturer</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Country</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Model No.</th>
                                    <th class="p-3 fs-14 bg-blue text-white">MDMA / GHTF No.</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Classification</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Dimensions (WxLxH)</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Product Warehouse</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Price(SAR)</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Category</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Sub Category</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Sub Sub Category</th>
                                    <th class="p-3 fs-14 bg-blue text-white">Actions</th>

                                </tr>
                                </thead>
                                @include('supplier.partials.product_table') <!-- Load initial table content -->
                            </table>
                        </div>

                        <nav aria-label="Page navigation example" class="mt-5 mb-4 wow animated fadeInDown pag">
                            <ul class="pagination justify-content-center">
                                {{-- Previous Page Link --}}
                                @if ($products->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link p-3 fs-13"><i class="fa fa-angle-left"></i></span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link p-3 fs-13" href="{{ $products->previousPageUrl() }}">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                @endif

                                {{-- Page Numbers --}}
                                @foreach ($products->links()->elements[0] as $page => $url)
                                    <li class="page-item {{ $products->currentPage() == $page ? 'active bg-blue' : '' }}">
                                        <a class="page-link p-3 fs-13" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($products->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link p-3 fs-13" href="{{ $products->nextPageUrl() }}">
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
    </section>
    <div id="imageUploadModal" class="modal fade" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="imageUploadForm" enctype="multipart/form-data">
                        <p>Select Type </p>
                        <div class="p-2">
                            <input type="radio" id="internalStorage" name="storageType" value="internal">
                            <label for="internalStorage">Local Images</label>
                        </div>

                        <div class="p-2">
                            <input type="radio" id="onlineLink" name="storageType" value="online">
                            <label for="onlineLink">Online Link</label>
                        </div>


                        <div class="row">
                            <div class="col-lg-6 d-none">
                                <div class="my-4 wow animated fadeInDown position-relative">
                                    <label class="form-label">Upload Images &amp; Videos</label>
                                    <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Example: 789654" name="files[]" id="fileInputImage" onchange="previewFiles()" />
                                    <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>
                                </div>
                            </div>
                            <input type="hidden" id="product_id" name="product_id">
                            <div class="col-12">
                                <div class="my-4 wow animated fadeInDown">
                                    <div id="fileListImage" class="d-flex flex-wrap gap-2"></div>

                                </div>
                            </div>
                        </div>

                        <div class="mb-3 d-none">
                            <label class="form-label">Enter Image Links (Use "|" to Separate)</label>
                            <textarea type="text" id="imageFile" name="image" class="form-control"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Upload</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            function fetchProducts() {
                let search = $('#search_name').val();
                console.log('search',search)
                let sort = $('select[name="sort"]').val();

                $.ajax({
                    url: "{{ route('product.filter') }}",
                    type: "GET",
                    data: {
                        search: search,

                        sort: sort
                    },
                    beforeSend: function() {
                        $('#product-table tbody').html('<tr><td colspan="14" class="text-center">Loading...</td></tr>');
                    },
                    success: function (response) {
                        if (response.status === 'success') {
                            $('#product-table tbody').html(response.html);
                        }
                    }
                });
            }

            // Search event
            $('#search_name').on('keyup', function () {
                fetchProducts();
            });

            // Filter events
            $('select').on('change', function () {
                fetchProducts();
            });
        });
    </script>



    <script>




        let selectedFiles = [];

        function previewFiles() {
            const fileInput = document.getElementById("fileInputImage");
            const fileList = document.getElementById("fileListImage");

            Array.from(fileInput.files).forEach((file) => {
                selectedFiles.push(file);
            });

            updateFileList();
        }

        function updateFileList() {
            const fileList = document.getElementById("fileListImage");
            fileList.innerHTML = "";

            selectedFiles.forEach((file, index) => {
                const fileType = file.type.startsWith("video/") ? "video" : "image";
                const fileName = file.name;

                const fileElement = document.createElement("a");
                fileElement.href = "javascript:;";
                fileElement.className = "btn btn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill";
                fileElement.innerHTML = `
                <i class="fa fa-${fileType === "video" ? "video" : "image"} text-purple"></i> ${fileName}
                <i class="fa fa-times text-danger ms-1" onclick="removeFile(${index})"></i>
            `;

                fileList.appendChild(fileElement);
            });

            updateFileInput();
        }

        function removeFile(index) {
            selectedFiles.splice(index, 1);
            updateFileList();
        }

        function updateFileInput() {
            const fileInput = document.getElementById("fileInputImage"); // Fixed ID
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach((file) => dataTransfer.items.add(file));

            fileInput.files = dataTransfer.files;
        }

    </script>



@endsection
