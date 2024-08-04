@extends('Layout.client')
@section('content')
    <div class="shop-page pt-120 mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="shop-sidebar">
                        <div class="shop-widget">
                            <h5 class="shop-widget-title">Price Range</h5>
                            <div class="range-widget">
                                <div id="slider-range" class="price-filter-range"></div>
                                <div class="mt-25 d-flex justify-content-between gap-4">
                                    <input type="number" min="100" max="499"
                                        oninput="validity.valid||(value='100');" id="min_price" class="price-range-field" />
                                    <input type="number" min="100" max="500"
                                        oninput="validity.valid||(value='500');" id="max_price" class="price-range-field" />
                                </div>
                            </div>
                        </div>
                        <div class="shop-widget">
                            <div class="check-box-item">
                                <h5 class="shop-widget-title">Category</h5>
                                <div class="checkbox-container">
                                    @foreach ($categories as $category)
                                        <label class="containerss">{{ $category->name }}
                                            <input value="{{ $category->id }}" type="checkbox">
                                            <span class="checkmark"></span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="row mb-50">
                        <div class="col-lg-12">
                            <div class="multiselect-bar">
                                <h6>shop</h6>
                                <div class="multiselect-area">
                                    <div method="GET" action="{{ route('shop') }}" class="single-select">
                                        <span>Show</span>
                                        <select class="defult-select-drowpown" id="product-dropdown">
                                            <option selected value="12">12</option>
                                            <option value="15">15</option>
                                            <option value="18">18</option>
                                            <option value="21">21</option>
                                            <option value="25">25</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 justify-content-center">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-4 col-sm-6">
                                <div class="collection-card">
                                    <div class="collection-img">
                                        @if (Storage::disk('public')->exists($product->image))
                                            <img style="height: 153px;" class="img-gluid"
                                                src="{{ Storage::url($product->image) }}" alt>
                                        @else
                                            <img style="height: 153px;" class="img-gluid" src="{{ $product->image }}" alt>
                                        @endif
                                        <div class="view-dt-btn">
                                            <div class="plus-icon">
                                                <i class="bi bi-plus"></i>
                                            </div>
                                            <a onclick="addToCart({{ $product->id }})">Add to cart</a>
                                        </div>
                                    </div>
                                    <div class="collection-content text-center">
                                        <h4><a href="{{ route('shop.detail') }}">{{ $product->name }}</a></h4>
                                        @if ($product->price_sale)
                                            <div class="price">
                                                <h6>{{ number_format($product->price_sale, 0, ',', '.') }} ₫</h6>
                                                <del>{{ number_format($product->price, 0, ',', '.') }} ₫</del>
                                            </div>
                                        @else
                                            <h6>{{ number_format($product->price, 0, ',', '.') }} ₫</h6>
                                        @endif

                                        <div class="review">
                                            <ul>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                                <li><i class="bi bi-star-fill"></i></li>
                                            </ul>
                                            <span>(50)</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="row pt-70">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <div class="paginations-area">
                                {{-- <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <li class="page-item"><a class="page-link" href="#"><i
                                                    class="bi bi-arrow-left-short"></i></a></li>
                                        <li class="page-item active"><a class="page-link" href="#">01</a></li>
                                        <li class="page-item"><a class="page-link" href="#">02</a></li>
                                        <li class="page-item"><a class="page-link" href="#">03</a></li>
                                        <li class="page-item"><a class="page-link" href="#"><i
                                                    class="bi bi-arrow-right-short"></i></a></li>
                                    </ul>
                                </nav> --}}
                                {{ $products->links('pagination::bootstrap-5') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function addToCart(idProduct) {
            let data = {
                idProduct: idProduct,
                idUser: {{ Auth::user()->id }}
            }
            $.ajax({
                type: "POST",
                url: "{{ route('api.cart.add') }}",
                data: data,
                dataType: "Json",
                success: function(response) {
                    if (response.success) {
                        toastr.success(response.message)
                    } else {
                        toastr.error('Đã có lỗi xảy ra!');
                    }
                }
            });
        }
    </script>
@endsection
