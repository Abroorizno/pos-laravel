<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('assets/') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>{{ $tittle ?? '' }}</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- SummerNotes -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    @include('sweetalert::alert')
        <div class="layout-wrapper layout-content-navbar">
            <div class="layout-container">
                <!-- Menu -->

                <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
                    @include('layouts.inc.sidebar')
                </aside>
                <!-- / Menu -->

                <!-- Layout container -->
                <div class="layout-page">
                    <!-- Navbar -->
                    <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
                        @include('layouts.inc.header')
                    </nav>
                    <!-- / Navbar -->

                    <!-- Content wrapper -->
                    <div class="content-wrapper">

                        <!-- Content -->
                            @yield('content')
                        <!-- / Content -->

                        <!-- Footer -->
                        <footer class="content-footer footer bg-footer-theme">
                        @include('layouts.inc.footer')
                        </footer>
                        <!-- / Footer -->

                        <div class="content-backdrop fade"></div>
                    <!-- / Content wrapper -->
                    </div>
                </div>
                <!-- / Layout page -->
            </div>
        </div>

        <!-- Overlay -->
        <div class="layout-overlay layout-menu-toggle"></div>
    <!-- / Layout wrapper -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('../assets/js/jquery-3.7.1.min.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- SummerNote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
            height: 100 // set editor height
            });
        });
    </script>

    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"]);

    <script>
        $(document).ready(function() {
        const modal = $('#add-orders'); // Dapatkan referensi ke modal

        function formatRupiah(amount) {
            return amount.toLocaleString('id-ID', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 0
            });
        }

        modal.find('#product_category').change(function() { // Cari elemen di dalam modal
            let category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: '/get-products/' + category_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        const productSubcategorySelect = modal.find('#product_subcategory'); // Cari elemen di dalam modal
                        productSubcategorySelect.empty();
                        productSubcategorySelect.append('<option value="" disabled selected>Select Product</option>');
                        $.each(data.data, function(key, value) {
                            productSubcategorySelect.append('<option value="' + value.id + '" data-price="'+ value.product_price +'" data-photo="'+ value.product_photo +'">' + value.product_name + '</option>');
                        });
                    }
                });
            } else {
                modal.find('#product_subcategory').empty(); // Cari elemen di dalam modal
            }
        });

        modal.find(".add-row").click(function() { // Cari elemen di dalam modal
            const tbody = modal.find('table tbody'); // Cari tbody di dalam modal
            const productCategory = modal.find("#product_category"); // Cari elemen di dalam modal
            const productSubcategory = modal.find("#product_subcategory"); // Cari elemen di dalam modal
            const selectedOption = productSubcategory.find('option:selected');
            const productName = selectedOption.text();
            const productPhoto = selectedOption.data('photo');
            const productPrice = parseInt(selectedOption.data('price'));

            if (productCategory.val() == '') {
                alert("Please select a category");
                return false;
            }

            if (productSubcategory.val() == '') {
                alert("Please select a product");
                return false;
            }

            let newRow = `
                <tr>
                    <td><img src='{{ asset('storage/') }}/${productPhoto}' alt='Product Image' style='width: 100px; height: 100px;'></td>
                    <td>
                        <span>${selectedOption.text()}</span>
                        <input type='hidden' class='form-control' name='product_name[]' value='${selectedOption.text()}' readonly>
                    </td>
                    <td>
                        <input type='number' class='qty form-control' name='product_qty[]' value='1' min='0' style='width: 80px;'>
                    </td>
                    <td>
                        <span class='price' data-price='${productPrice}'>Rp. ${formatRupiah(productPrice)}</span>
                        <input type='hidden' class='form-control' name='product_price[]' value='${productPrice}' readonly>
                    </td>
                    <td>
                        <span class='subtotal'>Rp. ${formatRupiah(productPrice)}</span>
                        <input type='hidden' class='form-control' name='product_subtotal[]' value='${productPrice}' readonly>
                    </td>
                    <td>
                        <button type='button' class='btn btn-danger on-delete'>Remove</button>
                    </td>
                </tr>
            `;

            tbody.append(newRow);
            grandTotal();
            clearAll();
        });

        modal.find('table tbody').on('input', '.qty', function() { // Cari tbody di dalam modal
            let row = $(this).closest('tr');
            let qty = parseInt($(this).val()) || 0;
            let price = parseInt(row.find('.price').data('price')) || 0;
            let subtotals = qty * price;

            row.find('.subtotal').text('Rp. ' + formatRupiah(subtotals));
            row.find('input[name="product_subtotal[]"]').val(subtotals);
            row.find('input[name="product_qty[]"]').val(qty);
            row.find('input[name="product_price[]"]').val(price);
            row.find('input[name="product_name[]"]').val(row.find('span').text());

            grandTotal();
        });

        function grandTotal() {
            let grandTotal = 0;
            modal.find('table tbody .subtotal').each(function() { // Cari elemen di dalam modal
                let subtotal = parseInt($(this).text().replace(/[^0-9]/g, '')) || 0;
                grandTotal += subtotal;
            });

            modal.find('#grandTotal').text('Rp. ' + formatRupiah(grandTotal)); // Cari elemen di dalam modal
            modal.find('input[name="grandTotal"]').val(grandTotal); // Cari elemen di dalam modal
        }

        function clearAll() {
            modal.find("#product_category").val(""); // Cari elemen di dalam modal
            modal.find("#product_subcategory").empty().append('<option value="" disabled selected>Select Product</option>'); // Cari elemen di dalam modal
        }

        modal.find('table tbody').on('click', '.on-delete', function() { // Cari tbody di dalam modal
            $(this).closest('tr').remove();
            grandTotal();
        });
    });
    </script>
  </body>
</html>

