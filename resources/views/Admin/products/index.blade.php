@extends('Layout.admin')
@section('styles')
    <link rel="stylesheet" href="{{ asset('assets/plugin/nouislider/nouislider.min.css') }}">
@endsection

@section('content')
    <div class="main px-lg-4 px-md-4">

        <!-- Body: Header -->
        @include('Admin.header')

        <!-- Body: Body -->
        <div class="body d-flex py-3">
            <div class="container-xxl">
                <div class="row align-items-center">
                    <div class="border-0 mb-4">
                        <div
                            class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                            <h3 class="fw-bold mb-0">Products</h3>
                        </div>
                    </div>
                </div> <!-- Row end  -->
                <div class="row g-3 mb-3">
                    <div class="col-md-12 col-lg-4 col-xl-4 col-xxl-3">
                        <div class="sticky-lg-top">
                            <div class="card mb-3">
                                <div class="reset-block">
                                    <div class="filter-title">
                                        <h4 class="title">Filter</h4>
                                    </div>
                                    <div class="filter-btn">
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="categories">
                                    <div class="filter-title">
                                        <a class="title" data-bs-toggle="collapse" href="#category" role="button"
                                            aria-expanded="true">Categories</a>
                                    </div>
                                    <div class="collapse show" id="category">
                                        <div class="filter-search">
                                            <form action="#">
                                                <input type="text" placeholder="Search" class="form-control">
                                                <button><i class="lni lni-search-alt"></i></button>
                                            </form>
                                        </div>
                                        <div class="filter-category">
                                            <ul class="category-list ">
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <input type="checkbox" name="category"
                                                            id="category{{ $category->id }}"><label class="ms-2"
                                                            for="category{{ $category->id }}">{{ $category->name }}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="price-range-block">
                                    <div class="filter-title">
                                        <a class="title" data-bs-toggle="collapse" href="#pricingTwo" role="button"
                                            aria-expanded="false">Pricing Range</a>
                                    </div>
                                    <div class="collapse show" id="pricingTwo">
                                        <div class="price-range">
                                            <div class="price-amount flex-wrap">
                                                <div class="amount-input mt-1">
                                                    <label class="fw-bold">Minimum Price</label>
                                                    <input type="text" id="minAmount2" class="form-control">
                                                </div>
                                                <div class="amount-input mt-1">
                                                    <label class="fw-bold">Maximum Price</label>
                                                    <input type="text" id="maxAmount2" class="form-control">
                                                </div>
                                            </div>
                                            <div id="slider-range2"
                                                class="slider-range noUi-target noUi-ltr noUi-horizontal noUi-txt-dir-ltr">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="rating-block">
                                    <div class="filter-title">
                                        <a class="title" data-bs-toggle="collapse" href="#rating" role="button"
                                            aria-expanded="false">Select Rating</a>
                                    </div>
                                    <div class="collapse show" id="rating">
                                        <div class="filter-rating">
                                            <ul>
                                                <li>
                                                    <div class="rating-check">
                                                        <input type="checkbox" id="rating-5">
                                                        <label for="rating-5"><span></span>

                                                        </label>
                                                        <p>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="rating-check">
                                                        <input type="checkbox" id="rating-4">
                                                        <label for="rating-4"><span></span></label>
                                                        <p>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="rating-check">
                                                        <input type="checkbox" id="rating-3">
                                                        <label for="rating-3"><span></span></label>
                                                        <p>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="rating-check">
                                                        <input type="checkbox" id="rating-2">
                                                        <label for="rating-2"><span></span></label>
                                                        <p>
                                                            <i class="icofont-star"></i>
                                                            <i class="icofont-star"></i>
                                                        </p>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="rating-check">
                                                        <input type="checkbox" id="rating-1">
                                                        <label for="rating-1"><span></span></label>
                                                        <p>
                                                            <i class="icofont-star"></i>
                                                        </p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-8 col-xl-8 col-xxl-9">
                        <div class="card mb-3 bg-transparent p-2">
                            @foreach ($products as $product)
                                <div class="card border-0 mb-1">

                                    <div class="card-body d-flex align-items-center flex-column flex-md-row">
                                        <a href="product-detail.html">
                                            <img class="w120 rounded img-fluid"
                                                src="{{ $product->image ? Storage::url($product->image) : asset('assets/images/product/product-1.jpg') }}"
                                                alt="">
                                            <img class="w120 rounded img-fluid" src="{{ $product->image }}"
                                                alt="">
                                        </a>
                                        <div class="ms-md-4 m-0 mt-4 mt-md-0 text-md-start text-center w-100">
                                            <a href="product-detail.html">
                                                <h6 class="mb-3 fw-bold"> {{ $product->name }}
                                                    @if ($product->status == 'published')
                                                        <span class="badge text-bg-success">Published</span>
                                                    @else
                                                        <span class="badge text-bg-danger">Hidden</span>
                                                    @endif
                                                    <span class="text-muted small fw-light d-block">
                                                        {{ $product->category_name }}
                                                    </span>
                                                </h6>
                                            </a>
                                            <div
                                                class="d-flex flex-row flex-wrap align-items-center justify-content-center justify-content-md-start">
                                                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                    <div class="text-muted small">Created At</div>
                                                    <strong>{{ $product->created_at->format('d-m-Y H:m:i') }}</strong>
                                                </div>
                                                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                    <div class="text-muted small">Price</div>
                                                    <strong>{{ number_format($product->price, 0, ',', '.') }}</strong>
                                                </div>
                                                @if ($product->price_sale)
                                                    <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                        <div class="text-muted small">Price Sale</div>
                                                        <strong>{{ number_format($product->price_sale, 0, ',', '.') }}</strong>
                                                    </div>
                                                @endif
                                                <div class="pe-xl-5 pe-md-4 ps-md-0 px-3 mb-2">
                                                    <div class="text-muted small">Ratings</div>
                                                    <strong><i class="icofont-star text-warning"></i>4.5 <span
                                                            class="text-muted">(145)</span></strong>
                                                </div>
                                            </div>
                                            <div class="position-absolute" style="right: 20px; bottom: 20px;">
                                                <a class="btn btn-warning"
                                                    href="{{ route('admin.product.edit', $product->id) }}">Sửa</a>
                                                <form class="d-inline" method="POST"
                                                    action="{{ route('admin.product.destroy', $product->id) }}"
                                                    onsubmit="confirmBtn(event)">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-outline-danger"
                                                        href="">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-md-12">
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div> <!-- Row end  -->
            </div>
        </div>

        <!-- Modal Custom Settings-->
        @include('Admin.setting')

    </div>
@endsection

@section('scripts')
    <!-- Jquery Core Js -->
    <script src="{{ asset('assets/bundles/libscripts.bundle.js') }}"></script>
    <!-- Jquery Plugin -->
    <script src="{{ asset('assets/plugin/nouislider/nouislider.min.js') }}"></script>

    <!-- Jquery Page Js -->
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script>
        var stepsSlider2 = document.getElementById('slider-range2');
        var input3 = document.getElementById('minAmount2');
        var input4 = document.getElementById('maxAmount2');
        var inputs2 = [input3, input4];
        noUiSlider.create(stepsSlider2, {
            start: [100000, 500000],
            connect: true,
            step: 1,
            range: {
                'min': [0],
                'max': 20000000
            },

        });

        stepsSlider2.noUiSlider.on('update', function(values, handle) {
            inputs2[handle].value = values[handle];
        });
    </script>
    <script>
        function confirmBtn(event) {
            event.preventDefault();

            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa sản phẩm này?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit();
                }
            });
        }
    </script>
@endsection
