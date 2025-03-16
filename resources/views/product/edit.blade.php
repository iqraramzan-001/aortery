@extends('front.layouts.layout')
@section('title',"Product")
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
                    <div class="bg-white rounded-2 p-4 pt-0 shadow-sm animated wow fadeInDown h-100">
                        <div class="d-sm-flex justify-content-between align-items-center">
                            <h3 class="h5 fw-bold animated pt-4 wow fadeInDown mb-0">Add Product</h3>
                            <div class="d-flex gap-2 mt-4">
                                <a href="{{ route('product.download') }}" class="btn btn-blue btn-sm rounded-pill px-3">Download CSV</a>

                                <form id="csvUploadForm" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <!-- Hidden File Input -->
                                    <input type="file" name="csv_file" accept=".csv" required id="csvFileInput" class="d-none">

                                    <!-- Custom Upload Button -->
                                    <label for="csvFileInput" class="btn btn-purple btn-sm rounded-pill px-3 cursor-pointer">Upload CSV</label>
                                </form>
                            </div>

                        </div>
                        <hr />
                        <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">SKU <span class="text-danger">*</span></label>
                                        <input type="text" name="sku" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 13245" value="{{$product->sku}}"   />
                                        @error('sku')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Product Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Weight Loss Belt" value="{{$product->name}}"   />
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Manufacturer <span class="text-danger">*</span></label>
                                        <input type="text" name="manufacturer" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Medikit One" value="{{$product->manufactrer}}"   />
                                        @error('manufacturer')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Country of Region <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: USA" name="country" value="{{$product->country}}" />
                                        @error('country')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Model No. <span class="text-danger">*</span></label>
                                        <input type="text"  name="model_no" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 465879" value="{{$product->model_no}}"  />
                                        @error('model_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">MDMA / GHTF Number <span class="text-danger">*</span></label>
                                        <input type="text"  name="mdma_no" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: MDMA-879654" value="{{$product->mdma_no}}"  />
                                        @error('mdma_no')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="mt-2 wow animated fadeInDown align-items-center d-flex justify-content-between">
                                        <label class="form-label fw-bold">Classifications</label>
                                    </div>
                                </div>
                                @php
                                    $selectedClassification = old('classification', $product->classification->value ?? '');
                                @endphp

                                <div class="col-12">
                                    <div class="mt-2 wow animated fadeInDown align-items-center d-flex gap-3">
                                        @foreach(['Class I', 'Class II', 'Class III', 'Class IV', 'Class V', 'Class VI'] as $class)
                                            <div class="form-check">
                                                <input class="form-check-input mt-0 border" type="radio" name="classification"
                                                       value="{{ $class }}"
                                                    {{ $selectedClassification === $class ? 'checked' : '' }} />
                                                <label class="form-check-label">{{ $class }}</label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>




                                <div class="col-l2">
                                    <div class="wow animated fadeInDown">
                                        <label class="form-label fw-bold mt-4">Dimensions <span class="text-danger">*</span></label>
                                        <div class="row">
                                            <div class="col">
                                                <div class="my-4 wow animated fadeInDown">
                                                    <label class="form-label">Width</label>
                                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 55" name="width" value="{{$product->width}}"/>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="my-4 wow animated fadeInDown">
                                                    <label class="form-label">Length</label>
                                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 88" name="length"  value="{{$product->length}}"/>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="my-4 wow animated fadeInDown">
                                                    <label class="form-label">Height</label>
                                                    <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: 15" name="height" value="{{$product->height}}" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Price in SAR <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Xoft Med Corp" name="price" value="{{$product->price}}" />
                                        @error('price')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Discount  Price</label>
                                        <input type="text" class="form-control p-3 rounded-pill shadow-none" placeholder="Example: Xoft Med Corp" name="discount_price" value="{{$product->discount_price}}"/>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Product Warehouse</label>
                                        <select id="category" name="warehouse_id" class="form-select shadow-none p-3 rounded-pill">
                                            <option value="">Choose Warehouse</option>
                                            @foreach($warehouse as $house)
                                                <option value="{{ $house->id }}"
                                                    {{ old('warehouse_id', $product->warehouse_id) == $house->id ? 'selected' : '' }}>
                                                    {{ $house->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Category <span class="text-danger">*</span></label>
                                        <select id="main_category" name="category_id" class="form-select shadow-none p-3 rounded-pill">
                                            <option value="">Choose Category</option>
                                            @foreach($category as $cat)
                                                <option value="{{ $cat->id }}" {{ $cat->id == $product->category_id ? 'selected' : '' }}>
                                                    {{ $cat->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Sub-Category <span class="text-danger">*</span></label>
                                        <select id="subcategory"  name="subcategory_id" class="form-select shadow-none p-3 rounded-pill">
                                            <option value="">Choose Sub-Category</option>
                                        </select>
                                        @error('subcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Sub-Sub-Category <span class="text-danger">*</span></label>
                                        <select id="subsubcategory" name="subsubcategory_id"  class="form-select shadow-none p-3 rounded-pill">
                                            <option value="">Choose Sub-Sub-Category</option>
                                        </select>
                                        @error('subsubcategory_id')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="my-4 wow animated fadeInDown position-relative">
                                        <label class="form-label">Upload Images &amp; Videos</label>
                                        <input type="file" multiple class="form-control fs-3 rounded-pill shadow-none position-relative z-1 opacity-0" placeholder="Example: 789654" name="files[]" id="fileInput" onchange="previewFiles()" />
                                        <button class="btn btn-darks p-3 w-100 rounded-pill position-absolute bottom-0"><i class="fa fa-upload me-1"></i> Upload PDF File</button>


                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <label class="form-label">Uploaded Files</label>
                                        <div id="fileList" class="d-flex flex-wrap gap-2"></div>

                                        @error('files')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-3">
                                    @foreach($product->images  as $doc)
                                        <a href="javascript:;" class="btn btn-light border d-flex align-items-center gap-1 p-3 fs-14 rounded-pill">
                                            <i class="fa fa-file-pdf text-purple"></i> {{$doc->file}}
                                            <i class="fa fa-times text-danger ms-1"></i>
                                        </a>
                                    @endforeach
                                </div>

                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <textarea name="description" id="editor">{{ old('description', $product->description) }}</textarea>
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="my-4 wow animated fadeInDown">
                                        <button name="btn"  type="submit" class="btn btn-blue p-3 px-5 rounded-pill"  data-bs-target="#successModal" data-bs-toggle="modal">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
    </section>
    <script>
        let selectedFiles = [];

        function previewFiles() {
            const fileInput = document.getElementById("fileInput");
            const fileList = document.getElementById("fileList");

            Array.from(fileInput.files).forEach((file) => {
                selectedFiles.push(file);
            });

            updateFileList();
        }

        function updateFileList() {
            const fileList = document.getElementById("fileList");
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
            const fileInput = document.getElementById("fileInput");
            const dataTransfer = new DataTransfer();

            selectedFiles.forEach((file) => dataTransfer.items.add(file));

            fileInput.files = dataTransfer.files;
        }
    </script>
@endsection
