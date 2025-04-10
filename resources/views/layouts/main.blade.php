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
        $('#product_category').change(function() {
            var category_id = $(this).val();
            if (category_id) {
                $.ajax({
                    url: '/get-products/' + category_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data) {
                        // console.log("Result : ", data);
                        $('#product_subcategory').empty();
                        $('#product_subcategory').append('<option value="" disabled selected>Select Product</option>');
                        $.each(data.data, function(key, value) {
                            $('#product_subcategory').append('<option value="' + value.id + '" data-price="'+ value.product_price +'" data-photo="'+ value.product_photo +'">' + value.product_name + '</option>');
                        });
                    }
                });
            } else {
                $('#product_subcategory').empty();
            }
        });

        $(".add-row").click(function(){
            let tbody = $('tbody');
            let selectedOption = $("#product_subcategory").find("option:selected");
            let productPrice = selectedOption.data('price');
            let productPhoto = selectedOption.data('photo');
            // console.log(productPrice);

            function formatRupiah(amount) {
                return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
            }

            if($("#category_id").val() == ""){
                alert("Please select a category");
                return false;
            }
            if($("#product_subcategory").val() == ""){
                alert("Please select a product");
                return false;
            }

            let newRow = "<tr>";
                newRow += "<td><img src='{{ asset('storage/') }}/" + productPhoto + "' alt='Product Image' style='width: 100px; height: 100px;'></td>";

                newRow += "<td>" + $("#product_subcategory option:selected").text() + "<input type='hidden' class='form-control' name='product_name[]' value='" + $("#product_subcategory option:selected").text() + "' readonly></td>";

                newRow += "<td><input type='number' class='form-control' name='product_qty[]' value='1' style='width: 80px;'></td>";

                newRow += "<td>Rp. " + formatRupiah(productPrice) + " <input type='hidden' class='form-control' name='product_price[]' value='" + productPrice + "' readonly></td>";

                newRow += "</tr>";

            tbody.append(newRow);

            clearAll();
        });

        function clearAll(){
            $("#product_category").val("");
            $("#product_subcategory").empty();
            $("#product_subcategory").append('<option value="" disabled selected>Select Product</option>');

        }

        // $(".remove-row").click(function(){
        //     let tbody = $('tbody');
        //     let lastRow = tbody.find('tr:last');
        //     if(lastRow.length){
        //         lastRow.remove();
        //     }
        // });

        // $(".remove-all").click(function(){
        //     let tbody = $('tbody');
        //     tbody.empty();
        // });

        // $(".submit").click(function(){
        //     let tbody = $('tbody');
        //     let lastRow = tbody.find('tr:last');
        //     if(lastRow.length){
        //         lastRow.remove();
        //     }
        // });
    </script>
  </body>
</html>
