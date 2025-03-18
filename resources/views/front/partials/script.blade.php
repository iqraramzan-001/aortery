<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"></script>
<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    new WOW().init();
    CKEDITOR.replace('editor');

</script>

<script>
    $(document).ready(function () {


        $('#main_category').on('change', function () {
            console.log('inside categry change');
            let categoryId = $(this).val();
            console.log("catgeory Id", categoryId);
            $('#subcategory').html('<option value="">Choose Sub-Category</option>');
            $('#subsubcategory').html('<option value="">Choose Sub-Sub-Category</option>');

            if (categoryId) {
                $.ajax({
                    url: '/categories/' + categoryId,
                    type: 'GET',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#subcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });


        $('#subcategory').on('change', function () {
            let subcategoryId = $(this).val();
            $('#subsubcategory').html('<option value="">Choose Sub-Sub-Category</option>');

            if (subcategoryId) {
                $.ajax({
                    url: '/categories/' + subcategoryId,
                    type: 'GET',
                    success: function (data) {
                        $.each(data, function (key, value) {
                            $('#subsubcategory').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });





        $(document).on('click', '.update-status-btn', function () {
            let url = $(this).data('url');

            $.ajax({
                url: url,
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    location.reload();
                },
                error: function (xhr) {
                    alert("Error updating status!");
                }
            });
        });

        $("#placeOrderBtn").click(function (e) {



            $.ajax({
                url: "{{ route('order.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}"
                },
                beforeSend: function () {
                    $("#placeOrderBtn").prop("disabled", true).text("Processing...");
                },
                success: function (response) {
                    $("#orderMessage").html(
                        '<div class="alert alert-success">✅ Order placed successfully!</div>'
                    );

                    setTimeout(() => {
                        location.reload();
                        {{--window.location.href = "{{ route('orders.success') }}";--}}

                    }, 2000);
                },
                error: function (xhr) {
                    let errorMessage = "Something went wrong!";
                    if (xhr.responseJSON && xhr.responseJSON.error) {
                        errorMessage = xhr.responseJSON.error;
                    }

                    $("#orderMessage").html(
                        '<div class="alert alert-danger">❌ ' + errorMessage + "</div>"
                    );

                    $("#placeOrderBtn").prop("disabled", false).text("Place Order");
                }
            });
        });

        $(document).on("click", ".add", function () {
            let inputField = $(this).siblings(".quantity-input");
            let currentValue = parseInt(inputField.val());

            if (currentValue < 999) {
                inputField.val(currentValue + 1);
            }
        });


        $(document).on("click", ".sub", function () {
            let inputField = $(this).siblings(".quantity-input");
            let currentValue = parseInt(inputField.val());

            if (currentValue > 1) {
                inputField.val(currentValue - 1);
            }
        });

        // Add to Cart AJAX
        $(document).on("click", ".addToCartBtn", function (e) {
            console.log("inside add to cart")
            e.preventDefault();

            // let productId = $("#productId").val();
            let productId=$(".productId").val();
            let quantity = $(this).closest(".d-sm-flex").find(".quantity-input").val();
            console.log("Product",productId)
            console.log("quanty", quantity)


            $.ajax({
                url: "{{ route('cart.store') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    product_id: productId,
                    quantity: quantity
                },
                beforeSend: function () {
                    $(".addToCartBtn").prop("disabled", true).text("Adding...");
                },
                success: function (response) {
                    if (response.success) {
                        $("#cartMessage").html(
                            '<div class="alert alert-success">✅ ' + response.message + "</div>"
                        );

                        // Optionally update cart count
                        $("#cartCount").text(response.cart.total_items || 1);
                    }
                },
                error: function (xhr) {
                    let errorMessage = "Something went wrong!";
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }

                    $("#cartMessage").html(
                        '<div class="alert alert-danger">❌ ' + errorMessage + "</div>"
                    );
                },
                complete: function () {
                    $(".addToCartBtn").prop("disabled", false).text("Add To Cart");
                }
            });
        });

        $(".imageUploadModalBtn").click(function () {
            let productId = $(this).data("id"); // Get product ID
            $("#product_id").val(productId); // Hidden field mein set karein
            $("#imageUploadModal").modal("show");
        });


        $("#imageUploadForm").submit(function (e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData.append("_token", "{{ csrf_token() }}");

            $.ajax({
                url: "{{ route('image.upload') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                    // Disable button to prevent multiple submissions
                    $("button[type=submit]").prop("disabled", true).text("Uploading...");
                },
                success: function (response) {

                    $("#imageUploadModal").modal("hide");
                    location.reload(); // Refresh page after upload
                },
                error: function (xhr) {

                    $("button[type=submit]").prop("disabled", false).text("Upload");
                }
            });
        });



        $(".order-details").click(function () {
            let orderId = $(this).data("order-id");

            $.ajax({
                url: "/order/show/" + orderId,
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        let order = response.order;
                        let userType = $('#userType').val();

                        let orderDate = new Date(order.created_at).toLocaleDateString("en-GB", {
                            day: "numeric",
                            month: "short",
                            year: "numeric"
                        }).replace(",", "");


                        $("#orderDetailsModalLabel").text("Order #" + order.order_no);
                        $('#modal-order-no').text(order.order_no)
                        $('.order-id').val(order.id)
                        $('#modal-order-price').text(order.total_price)
                        $("#modal-order-date").text(orderDate);
                        $("#modal-buyer-name").text(order.buyer ? `${order.buyer.first_name} ${order.buyer.last_name}` : "N/A");

                        let itemsHtml = "";

                        order.items.forEach(item => {
                            let imgSrc = (item.product.images)
                                ? "/docs/" + item.product.images[0].file
                                : "/default.jpg";

                            let supplierName = order.supplier
                                ? `${order.supplier.first_name} ${order.supplier.last_name}`
                                : "Unknown Supplier";

                            // **✅ Supplier View**
                            if (userType === "supplier") {
                                itemsHtml += `
                            <div class="order-box shadow-sm transition px-4 py-1 mt-4 rounded-2 p-4">
                                <div class="row align-items-stretch">
                                    <div class="col-lg-2 col-md-4 col-sm-4 my-3">
                                        <div class="bg-white border p-3 rounded-2 h-100">
                                            <img src="${imgSrc}" class="img-fluid object-fit-cover h-100" />
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-8 col-sm-8 my-3">
                                        <h3 class="h5 lh-125">${item.product.name}</h3>
                                        <div class="d-flex gap-3 my-2 align-items-center">
                                            <strong>$${item.product.price}</strong>
                                            <input type="text" class="form-control text-center w-50p shadow-none" value="${item.quantity}" readonly />
                                            <p class="fs-13 d-block">Supplier: ${supplierName}</p>
                                        </div>
                                        <div class="d-lg-flex gap-3 mt-4 mb-1 align-items-center">
                                            <label class="mb-2 mb-lg-0">Warehouse:</label>
                                            <select class="form-select w-auto fs-14 shadow-none">
                                                <option>Al-Kharj Storing System</option>
                                                <option>Al-Kharj Storing System</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-12 col-sm-12 my-3">
                            <div class="order-box">
                                                <input type="hidden" class="orderItemId" value="${item.id}"/>
                                            </div>
                                            <textarea class="form-control shadow-none" name="notes" placeholder="Notes" rows="4">   ${item.notes ? item.notes : ''} </textarea>
                                            <div class="d-flex gap-3 align-items-center mt-4">
                                                <div class="form-check">
                                                    <input class="form-check-input mt-0 shadow-none" type="radio" name="status_${item.id}" id="r1_${item.id}" value="approve" ${item.status === 'approve' ? 'checked' : ''}>
                                                    <label class="form-check-label text-success" for="r1_${item.id}">Approve</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input mt-0 shadow-none" type="radio" name="status_${item.id}" id="r2_${item.id}" value="decline" ${item.status === 'decline' ? 'checked' : ''}>
                                                    <label class="form-check-label text-danger" for="r2_${item.id}">Decline</label>
                                                </div>
                                            </div>

                                </div>
                            </div>
                        `;
                            }
                            // **✅ Buyer View**
                            else if (userType === "buyer") {
                                itemsHtml += `
                            <div class="order-box shadow-sm transition px-4 py-1 mt-4 rounded-2 p-4">
                                <div class="row align-items-stretch">
                                    <div class="col-lg-2 col-md-4 col-sm-4 my-3">
                                        <div class="bg-white border p-3 rounded-2 h-100">
                                            <img src="${imgSrc}" class="img-fluid object-fit-cover h-100" />
                                        </div>
                                    </div>
                                    <div class="col-lg-7 col-md-8 col-sm-8 my-3">
                                          <input type="hidden" value=${item.id} class="orderItemId"/>
                                        <h3 class="h5 lh-125">${item.product.name}</h3>
                                        <div class="d-flex gap-3 my-3 align-items-center">
                                            <strong>$${item.product.price}</strong>
                                            <input type="text" class="form-control text-center w-50p shadow-none" value="${item.quantity}" readonly />
                                        </div>
                                        <p class="fs-13 d-block mt-3">Supplier: ${supplierName}</p>
                                       ${item.status === 'pending' ? `
                                                <button class="btn btn-outline-danger px-3 rounded-pill my-3 btn-sm item-update-status" data-id="${item.id}" data-status="canceled">
                                                    <i class="fa fa-times me-1"></i> Cancel Item
                                                </button>
                                            ` : ''}
                                    </div>
                                    <div class="col-lg-3 col-md-12 col-sm-12 my-3">
                                        <span class="badge bg-success px-2 rounded-pill my-2 btn-sm">
                                            <i class="fa fa-check me-1"></i> ${item.status}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        `;
                            }
                        });

                        $("#order-items-list").html(itemsHtml);

                        let modal = new bootstrap.Modal(document.getElementById("orderDetailsModal"));
                        modal.show();
                    } else {
                        alert("Order details not found.");
                    }
                },
                error: function () {
                    alert("Error fetching order details.");
                }
            });
        });

        $(document).on("click", ".update-status", function () {
            let orderId = $(".order-id").val();
            let status = $(this).data("status"); // Button ka status (approved/declined/canceled)

            let orderItems = [];

            // Har order item ka status aur note collect karo
            $("#order-items-list .order-box").each(function () {
                // let itemId = $(this).find(".orderItemId").val();
                // console.log("ITem ID",itemId);
                // let note = $(this).find("textarea").val();
                // console.log("notes",note);
                // let itemStatus = $(this).find("input[type=radio]:checked").length > 0
                //     ? $(this).find("input[type=radio]:checked").next("label").text().toLowerCase()
                //     : null;

                let itemId = $(this).find(".orderItemId").val();

                console.log("ITem ID",itemId);

                // Avoid duplicate processing
                if (!itemId || orderItems.some(item => item.id === itemId)) return;

                let note = $(this).find("textarea").val() || ""; // Ensure note is not undefined

                console.log("notes",note);
                let itemStatus = $(this).find("input[type=radio]:checked").val() || null;

                console.log("status",itemStatus);

                orderItems.push({
                    id: itemId,
                    note: note,
                    status: itemStatus
                });
            });

            // SweetAlert Confirmation
            let alertTitle = status === "declined" ? "Are you sure?" : "Confirm Order";
            let alertText = status === "declined" ? "Once declined, this action cannot be undone!" : "Do you want to approve this order?";
            let alertIcon = status === "declined" ? "warning" : "info";

            Swal.fire({
                title: alertTitle,
                text: alertText,
                icon: alertIcon,
                showCancelButton: true,
                confirmButtonColor: status === "declined" ? "#d33" : "#28a745",
                cancelButtonColor: "#6c757d",
                confirmButtonText: status === "declined" ? "Yes, Decline it!" : "Yes, Approve it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // AJAX Request
                    $.ajax({
                        url: "/order/status/" + orderId,
                        type: "POST",
                        data: JSON.stringify({
                            order_id: orderId,
                            status: status,
                            items: orderItems,
                            _token: "{{ csrf_token() }}"
                        }),
                        contentType: "application/json",
                        headers: {
                            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                        },
                        success: function (response) {
                            if (response.success) {
                                Swal.fire("Success!", "Order updated successfully!", "success").then(() => {
                                    $("#orderDetailsModal").modal("hide"); // Modal band karna
                                    location.reload(); // Page reload
                                });
                            } else {
                                Swal.fire("Error!", "Failed to update order.", "error");
                            }
                        },
                        error: function () {
                            Swal.fire("Error!", "Error updating order.", "error");
                        }
                    });
                }
            });
        });


        {{--        $(".update-status").click(function () {--}}
{{--            let status = $(this).data("status");--}}
{{--            let orderId = $(".order-id").val();--}}

{{--            console.log("ORder Id",orderId)--}}
{{--            if (status === "declined") {--}}
{{--                // Pehle confirmation alert dikhana--}}
{{--                Swal.fire({--}}
{{--                    title: "Are you sure?",--}}
{{--                    text: "Do you want to decline or cancel this order?",--}}
{{--                    icon: "warning",--}}
{{--                    showCancelButton: true,--}}
{{--                    confirmButtonColor: "#d33",--}}
{{--                    cancelButtonColor: "#3085d6",--}}
{{--                    confirmButtonText: "Yes, decline it!"--}}
{{--                }).then((result) => {--}}
{{--                    if (result.isConfirmed) {--}}
{{--                        updateOrderStatus(orderId, status); // Status update function call--}}
{{--                    }--}}
{{--                });--}}
{{--            } else {--}}
{{--                // Direct approve karein aur success alert show karein--}}
{{--                updateOrderStatus(orderId, status);--}}
{{--            }--}}
{{--        });--}}

{{--// Function to update order status via AJAX--}}
{{--        function updateOrderStatus(orderId, status) {--}}
{{--            $.ajax({--}}
{{--                url: "/order/status/" + orderId,--}}
{{--                type: "POST",--}}
{{--                data: {--}}
{{--                    status: status,--}}
{{--                    _token: "{{ csrf_token() }}"--}}
{{--                },--}}
{{--                success: function (response) {--}}
{{--                    if (response.success) {--}}
{{--                        Swal.fire({--}}
{{--                            title: "Success!",--}}
{{--                            text: "Order status updated to " + status,--}}
{{--                            icon: "success",--}}
{{--                            confirmButtonText: "OK"--}}
{{--                        }).then(() => {--}}
{{--                            $("#orderDetailsModal").modal("hide"); // Modal close karein--}}
{{--                            $(".order-id").val(null);--}}
{{--                            location.reload(); // Page reload karein--}}
{{--                        });--}}
{{--                    } else {--}}
{{--                        Swal.fire("Error", "Failed to update order status.", "error");--}}
{{--                    }--}}
{{--                },--}}
{{--                error: function () {--}}
{{--                    Swal.fire("Error", "Something went wrong!", "error");--}}
{{--                }--}}
{{--            });--}}
{{--        }--}}


        $(document).on("click", ".item-update-status", function () {
            console.log('Inside update item clicked');

            let status = $(this).data("status");
            let order=$(this).data('id');

            console.log("Current ORDER ID S....",order);

            let orderId = $(this).data('id');// Modal se order ID le raha hai

            console.log("ORder Item id",orderId)

            if (status === "canceled") {  // Ensure status is correctly checked
                Swal.fire({
                    title: "Are you sure?",
                    text: "Do you want to decline or cancel this order?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Yes, decline it!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        updateOrderItemStatus(orderId, status); // Status update function call
                    }
                });
            } else {
                updateOrderItemStatus(orderId, status);
            }
        });

        function updateOrderItemStatus(orderId, status) {
            $.ajax({
                url: "/order/item/status/" + orderId,
                type: "POST",
                data: {
                    status: status,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: "Success!",
                            text: "Order status updated to " + status,
                            icon: "success",
                            confirmButtonText: "OK"
                        }).then(() => {
                            $("#orderDetailsModal").modal("hide");
                            $(".orderItemId").val(null);
                            location.reload();
                        });
                    } else {
                        Swal.fire("Error", "Failed to update order status.", "error");
                    }
                },
                error: function () {
                    Swal.fire("Error", "Something went wrong!", "error");
                }
            });
        }


        $('input[name="storageType"]').on('change', function () {
            if ($(this).val() === 'internal') {
                // Show file upload section and hide the textarea
                $('.row .col-lg-6').removeClass('d-none');
                $('.mb-3').addClass('d-none');
            } else {
                // Show textarea and hide the file upload section
                $('.row .col-lg-6').addClass('d-none');
                $('.mb-3').removeClass('d-none');
            }
        });

        $('#csvFileInput').on('change', function () {
            console.log('bbbbbbbbb');
            var formData = new FormData();
            formData.append('csv_file', $('#csvFileInput')[0].files[0]);
            formData.append('_token', '{{ csrf_token() }}'); // Laravel CSRF token

            $.ajax({
                url: "{{ route('product.upload') }}", // Laravel route
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function (response) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'CSV uploaded successfully.',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'OK'
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error!',
                        text: 'Something went wrong. Please try again.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });
                }
            });
        });



        // Load the stored view (if any)
        let storedView = localStorage.getItem("selectedView") || "grid";
        updateView(storedView);

        // Handle View Toggle
        $(".view-toggle").on("change", function () {
            let selectedView = $(this).val();
            localStorage.setItem("selectedView", selectedView); // Store the selected view
            updateView(selectedView);
            fetchProducts(); // Refresh products after view change
        });

        // Handle Search Input
        $(".searchInput").on("keyup", function () {
            fetchProducts();

        });

        // Handle Filter Change
        $("#filterSelect").on("change", function () {
            fetchProducts();
        });

        $(".range-input input").on("change", function () {
            fetchProducts();
        });
        // Fetch Products with AJAX
        function fetchProducts() {
            let searchQuery = $("#searchInput").val();
            let filterValue = $("#filterSelect").val();
            let minPrice = $(".range-min").val();
            let maxPrice = $(".range-max").val();
            let viewType = localStorage.getItem("selectedView") || "grid";
            console

            $.ajax({
                url: "{{ route('products.search') }}",
                type: "GET",
                data: {
                    search: searchQuery,
                    filter: filterValue,
                    min_price: minPrice,
                    max_price: maxPrice,
                },
                success: function (response) {
                    if (viewType === "grid") {
                        $('#grid-View').html(response.gridView).show();
                        if (searchQuery.trim() !== "") {
                            $(".pag").hide(); // Hide pagination when searching
                        } else {
                            $(".pag").show(); // Show pagination if search is empty
                        }


                    } else {
                        $('#list-View').html(response.listView).show();
                        if (searchQuery.trim() !== "") {
                            $(".pag").hide(); // Hide pagination when searching
                        } else {
                            $(".pag").show(); // Show pagination if search is empty
                        }

                    }
                }
            });
        }


        function updateView(viewType) {
            if (viewType === "grid") {
                $("#gridViewRadio").prop("checked", true);
                $("#grid-View").show();
                $("#list-View").hide();
            } else {
                $("#listViewRadio").prop("checked", true);
                $("#list-View").show();
                $("#grid-View").hide();
            }
        }


        $(".deleteProductBtn").click(function(e) {

            e.preventDefault();

            let productId = $(this).data("id");
            let token = "{{ csrf_token() }}"; // CSRF token for security
            let url = "{{ route('product.delete', ':id') }}".replace(':id', productId);

            Swal.fire({
                title: "Are you sure?",
                text: "This action cannot be undone!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: {
                            _token: token
                        },
                        success: function(response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: response.message,
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Remove the row from the table
                            $("button[data-id='" + productId + "']").closest("tr").fadeOut(500, function() {
                                $(this).remove();
                            });
                        },
                        error: function(xhr) {
                            Swal.fire({
                                title: "Error!",
                                text: "Something went wrong. Please try again.",
                                icon: "error"
                            });
                        }
                    });
                }
            });
        });



            $('.openProductDetailModal').on('click', function() {

                let name = $(this).data('name');
                let image = $(this).data('image');
                let oldPrice = $(this).data('old-price');
                let newPrice = $(this).data('new-price');
                let supplier = $(this).data('supplier');
                let description = $(this).data('description');

                let cleanDescription = description.replace(/<[^>]*>/g, "");

                $('#productModalLabel').text(name);
                $('#modalProductImage').attr('src', image);
                $('#modalOldPrice').text(`$${oldPrice}`);
                $('#modalNewPrice').text(`$${newPrice}`);
                $('#modalSupplier').text(supplier);
                $("#modalDescription").text(cleanDescription);
            });



        $(".delete-cart-item").on("click", function (e) {
            e.preventDefault();

            let button = $(this);
            let cartId = button.data("id");
            let url = "{{ route('cart.delete', ':id') }}".replace(':id', cartId);
            Swal.fire({
                title: "Are you sure?",
                text: "This item will be removed from your cart.",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send AJAX request to delete
                    $.ajax({
                        url: url,
                        type: "DELETE",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        success: function (response) {
                            Swal.fire({
                                title: "Deleted!",
                                text: "Your item has been removed.",
                                icon: "success",
                                timer: 1500,
                                showConfirmButton: false
                            });

                            // Remove item from UI
                            $(".cart-item-" + cartId).fadeOut(500, function () {
                                $(this).remove();
                                calculateTotalPrice();
                            });

                        },
                        error: function (xhr) {
                            Swal.fire("Error!", "Could not remove the item.", "error");
                        }
                    });
                }
            });
        });

        function calculateTotalPrice() {
            console.log("Inside total")
            let total = 0;

            document.querySelectorAll('.quantity-input').forEach(function(input) {
                let price = parseFloat(input.getAttribute('data-price'));
                let quantity = parseInt(input.value);
                total += price * quantity;
            });
            console.log("total",total);

            document.getElementById('total-price').textContent = total.toFixed(2);
        }







    });
</script>

<script>

    $(document).ready(function() {

        const rangeInput = document.querySelectorAll(".range-input input"),
            priceInput = document.querySelectorAll(".price-input input"),
            range = document.querySelector(".slider .progress");
        let priceGap = 1000;

        priceInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = parseInt(priceInput[0].value),
                    maxPrice = parseInt(priceInput[1].value);

                if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "input-min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minVal = parseInt(rangeInput[0].value),
                    maxVal = parseInt(rangeInput[1].value);

                if (maxVal - minVal < priceGap) {
                    if (e.target.className === "range-min") {
                        rangeInput[0].value = maxVal - priceGap;
                    } else {
                        rangeInput[1].value = minVal + priceGap;
                    }
                } else {
                    priceInput[0].value = minVal;
                    priceInput[1].value = maxVal;
                    range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
                }
            });
        });


        $(document).ready(function () {
            $(".sub-menu").hide();
            $("#sub1").show();
            $(".main-cats li:first-child a").addClass("active");
            $(".main-cats li a").hover(function () {
                var index = $(this).parent().index();
                $(".main-cats li a").removeClass("active");
                $(this).addClass("active");
                $(".sub-menu").hide();
                $("#sub" + (index + 1)).show();
            });
        });

        $('.filter.title').click(function () {
            $('.overlay').addClass('shown');
            $('html').addClass('overflow-hidden');
        });
        $('.timess').click(function () {
            $('.overlay').removeClass('shown');
            $('html').removeClass('overflow-hidden');
        });


        new WOW().init();
    });
</script>




















