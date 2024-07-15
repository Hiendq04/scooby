<!doctype html>
<html class="no-js" lang="en" dir="ltr">

<!-- Mirrored from pixelwibes.com/template/ebazar/html/dist/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 15:21:55 GMT -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Admin - {{ $title }}</title>
    <link rel="icon" href="{{ asset('assets/images/sm-logo.svg') }}" type="image/x-icon"> <!-- Favicon-->

    <!-- plugin css file  -->
    <link rel="stylesheet" href="{{ asset('assets/plugin/datatables/responsive.dataTables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/datatables/dataTables.bootstrap5.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/plugin/cropper/cropper.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/plugin/dropify/dist/css/dropify.min.css') }}" />

    <!-- project css file  -->
    <link rel="stylesheet" href="{{ asset('assets/css/ebazar.style.min.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.min.css">

    @yield('styles')

    <style>
        .logo-icon>img {
            width: 20px;
            height: 20px;
            position: relative;
            top: 5px;
        }

        #loadingAdmin {
            width: 20px;
            height: 20px;
            border: 2px dotted white;
            border-radius: 50%;
            border-top-color: black;
            border-bottom-color: rgb(0, 0, 0);
            animation: loading 2s steps(2, end) infinite;
        }

        @keyframes loading {
            0% {
                transform: rotate(0deg);
            }

            50% {
                transform: rotate(180deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>
    <div id="ebazar-layout" class="theme-blue">

        <!-- sidebar -->
        <div class="sidebar px-4 py-4 py-md-4 me-0">
            <div class="d-flex flex-column h-100">
                <a href="{{ route('admin.dashboard') }}" class="mb-0 brand-icon">
                    <span class="logo-icon">
                        <img src="{{ asset('assets/images/sm-logo.svg') }}" alt="">
                    </span>
                    <span class="logo-text">Scooby</span>
                </a>
                <!-- Menu: main ul -->
                <ul class="menu-list flex-grow-1 mt-3">
                    <li><a class="m-link {{ $title == 'Dashboard' ? 'active' : '' }}"
                            href="{{ route('admin.dashboard') }}"><i class="icofont-home fs-5"></i>
                            <span>Dashboard</span></a></li>
                    <li class="collapsed">
                        <a class="m-link {{ $title == 'Category' ? 'active' : '' }}"
                            href="{{ route('admin.category.list') }}">
                            <i class="icofont-chart-flow fs-5"></i> <span>Categories</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-product" href="#">
                            <i class="icofont-truck-loaded fs-5"></i> <span>Products</span> <span
                                class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-product">
                            <li><a class="ms-link" href="product-grid.html">Product Grid</a></li>
                            <li><a class="ms-link" href="product-list.html">Product List</a></li>
                            <li><a class="ms-link" href="product-edit.html">Product Edit</a></li>
                            <li><a class="ms-link" href="product-detail.html">Product Details</a></li>
                            <li><a class="ms-link" href="product-add.html">Product Add</a></li>
                            <li><a class="ms-link" href="product-cart.html">Shopping Cart</a></li>
                            <li><a class="ms-link" href="checkout.html">Checkout</a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-order" href="#">
                            <i class="icofont-notepad fs-5"></i> <span>Orders</span> <span
                                class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-order">
                            <li><a class="ms-link" href="order-list.html">Orders List</a></li>
                            <li><a class="ms-link" href="order-details.html">Order Details</a></li>
                            <li><a class="ms-link" href="order-invoices.html">Order Invoices</a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ $title == 'Accounts' ? 'active' : '' }}"
                            href="{{ route('admin.account.list') }}">
                            <i class="icofont-funky-man fs-5"></i> <span>Accounts</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link {{ $title == 'Voucher' ? 'active' : '' }}" href="{{route('admin.voucher.list')}}">
                            <i class="icofont-sale-discount fs-5"></i> <span>Voucher</span></a>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#menu-inventory" href="#">
                            <i class="icofont-chart-histogram fs-5"></i> <span>Inventory</span> <span
                                class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="menu-inventory">
                            <li><a class="ms-link" href="inventory-info.html">Stock List</a></li>
                            <li><a class="ms-link" href="purchase.html">Purchase</a></li>
                            <li><a class="ms-link" href="supplier.html">Supplier</a></li>
                            <li><a class="ms-link" href="returns.html">Returns</a></li>
                            <li><a class="ms-link" href="department.html">Department</a></li>
                        </ul>
                    </li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#app" href="#">
                            <i class="icofont-code-alt fs-5"></i> <span>App</span> <span
                                class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="app">
                            <li><a class="ms-link" href="calendar.html">Calandar</a></li>
                            <li><a class="ms-link" href="chat.html"> Chat App</a></li>
                        </ul>
                    </li>
                    <li><a class="m-link" href="store-locator.html"><i class="icofont-focus fs-5"></i> <span>Store
                                Locator</span></a></li>
                    <li><a class="m-link" href="ui-elements/ui-alerts.html"><i class="icofont-paint fs-5"></i>
                            <span>UI Components</span></a></li>
                    <li class="collapsed">
                        <a class="m-link" data-bs-toggle="collapse" data-bs-target="#page" href="#">
                            <i class="icofont-page fs-5"></i> <span>Other Pages</span> <span
                                class="arrow icofont-rounded-down ms-auto text-end fs-5"></span></a>
                        <!-- Menu: Sub menu ul -->
                        <ul class="sub-menu collapse" id="page">
                            <li><a class="ms-link" href="admin-profile.html">Profile Page</a></li>
                            <li><a class="ms-link" href="purchase-plan.html">Price Plan Example</a></li>
                            <li><a class="ms-link" href="charts.html">Charts Example</a></li>
                            <li><a class="ms-link" href="table.html">Table Example</a></li>
                            <li><a class="ms-link" href="forms.html">Forms Example</a></li>
                            <li><a class="ms-link" href="icon.html">Icons</a></li>
                            <li><a class="ms-link" href="contact.html">Contact Us</a></li>
                            <li><a class="ms-link" href="todo-list.html">Todo List</a></li>
                        </ul>
                    </li>
                </ul>
                <!-- Menu: menu collepce btn -->
                <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                    <span class="ms-2"><i class="icofont-bubble-right"></i></span>
                </button>
            </div>
        </div>

        <!-- main body area -->
        @yield('content')

    </div>

    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>

    <!-- Plugin Js -->
    <script src="{{ asset('assets/bundles/apexcharts.bundle.js') }}"></script>
    <script src="{{ asset('assets/bundles/dataTables.bundle.js') }}"></script>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/page/index.js') }}"></script>
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB1Jr7axGGkwvHRnNfoOzoVRFV3yOPHJEU&amp;callback=myMap"> --}}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.8/dist/sweetalert2.all.min.js"></script>

    </script>
    <script>
        $('#myDataTable')
            .addClass('nowrap')
            .dataTable({
                responsive: true,
                columnDefs: [{
                    targets: [-1, -3],
                    className: 'dt-body-right'
                }]
            });

        var loading = '<div id="loadingAdmin"></div>';
    </script>
    @yield('scripts')
</body>

<!-- Mirrored from pixelwibes.com/template/ebazar/html/dist/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 06 May 2024 15:22:11 GMT -->

</html>
