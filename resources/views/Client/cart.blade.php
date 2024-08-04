@extends('Layout.client')
@section('content')
    <div class="cart-section pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-wrapper">
                        <table class="eg-table table cart-table">
                            <thead>
                                <tr>
                                    <th>Delete</th>
                                    <th>Image</th>
                                    <th>Food Name</th>
                                    <th>Unite Price</th>
                                    <th>Discount Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody id="cart_item">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row g-4">
                <div class="col-lg-4">
                    <div class="coupon-area">
                        <div class="cart-coupon-input">
                            <h5 class="coupon-title">Voucher</h5>
                            <div class="coupon-input d-flex align-items-center">
                                <input id="voucher" type="text" placeholder="Coupon Code">
                                <button id="apply_voucher" type="submit">Apply</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <table class="table total-table">
                        <thead>
                            <tr>
                                <th>Cart Totals</th>
                                <th></th>
                                <th id="total_cart_value"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Shipping</td>
                                <td>
                                    <ul class="cost-list text-start">
                                        <li>Shipping Fee</li>
                                    </ul>
                                </td>
                                <td>
                                    <ul class="single-cost text-center">
                                        <li>Free</li>
                                    </ul>
                                </td>
                            </tr>
                            <tr>
                                <td>Voucher</td>
                                <td>Voucher value</td>
                                <td id="voucher_value">0 ₫</td>
                            </tr>
                            <tr>
                                <td>Subtotal</td>
                                <td></td>
                                <td id="subtotal"></td>
                            </tr>
                        </tbody>
                    </table>
                    <ul class="cart-btn-group">
                        <li><a href="{{ route('shop') }}" class="primary-btn2 btn-lg">Continue to shopping</a></li>
                        <li><button id="proceed_to_checkout" class="primary-btn3 btn-lg">Proceed to Checkout</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <form class="d-none" id="getCheckOut" method="POST" action="{{ route('cart.save') }}">
        @csrf
        <input type="text" name="cart_total">
        <input type="text" name="voucher">
        <input type="text" name="voucher_value">
        <input type="text" name="subtotal">
        <input type="text" name="cart_items">
    </form>
@endsection

@section('scripts')
    <script>
        const formatCurrency = (amount) => {
            return new Intl.NumberFormat('vi-VN', {
                style: 'currency',
                currency: 'VND'
            }).format(amount);
        };
        const unformatCurrency = (formattedAmount) => {
            return parseInt(formattedAmount.replace(/[^\d]/g, ''), 10);
        };

        function updateSubTotal() {
            let cartTotal = unformatCurrency($('#total_cart_value').text())
            let voucher = unformatCurrency($('#voucher_value').text())

            $('#subtotal').html(formatCurrency(cartTotal - voucher));
            $("input[name='subtotal']").val(cartTotal - voucher)
        }


        var cartTotal = 0;

        function getCart() {
            let data = {
                id: {{ Auth::user()->id }}
            };
            $.ajax({
                type: "POST",
                url: "{{ route('api.cart.get') }}",
                data: data,
                dataType: "Json",
                success: function(response) {
                    if (response.success) {
                        cartTotal = 0;
                        const html = response.cart.map(cart => {
                            let product = cart.product;
                            let itemPrice = product.price_sale * cart.quantity;
                            cartTotal += itemPrice;
                            $("input[name='cart_total']").val(cartTotal)
                            return `
                                <tr>
                                    <td data-label="Delete">
                                        <div onclick="deleteItem(${cart.id})" class="delete-icon">
                                            <i class="bi bi-x"></i>
                                        </div>
                                    </td>
                                    <td data-label="Image">
                                        <img style="height: 65px; max-width: 200px;" src="${product.image}">
                                    </td>
                                    <td data-label="Food Name"><a href="https://demo.egenslab.com/html/scooby/preview/shop-details.html">
                                    ${product.name}</a></td>
                                    <td data-label="Unit Price"><del>${formatCurrency(product.price)}</del></td>
                                    <td data-label="Discount Price">${formatCurrency(product.price_sale)}</td>
                                    <td data-label="Quantity">
                                        <div class="quantity d-flex align-items-center">
                                            <div class="quantity-nav nice-number d-flex align-items-center">
                                                <button class="quantity-nav quantity-down">-</button>
                                                <input type="number" value="${cart.quantity}" min="1" class="quantity-input" data-product-id="${product.id}">
                                                <button class="quantity-nav quantity-up">+</button>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Subtotal" class="subtotal">${formatCurrency(product.price_sale * cart.quantity)}</td>
                                </tr>
                            `;
                        }).join('');
                        $('#cart_item').html(html);
                        $('#total_cart_value').text(formatCurrency(cartTotal));
                    } else {
                        toastr.error(response.messsage);
                    }
                    updateSubTotal();
                }
            });
        }

        getCart();

        $(document).on('click', '.quantity-up', function() {
            const input = $(this).siblings('.quantity-input');
            let currentValue = parseInt(input.val());
            let newValue = currentValue + 1;

            input.val(newValue).trigger('input');

            const productId = input.data('product-id');
            const data = {
                id: productId,
                quantity: newValue,
                idUser: {{ Auth::user()->id }}
            };

            $.ajax({
                type: "POST",
                url: "{{ route('api.cart.update') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    getCart();
                },
            });
        });

        $(document).on('click', '.quantity-down', function() {
            const input = $(this).siblings('.quantity-input');
            let currentValue = parseInt(input.val());
            let newValue = currentValue - 1;

            input.val(newValue).trigger('input');

            const productId = input.data('product-id');
            const data = {
                id: productId,
                quantity: newValue,
                idUser: {{ Auth::user()->id }}
            };

            $.ajax({
                type: "POST",
                url: "{{ route('api.cart.update') }}",
                data: data,
                dataType: "json",
                success: function(response) {
                    getCart();
                },
            });
        });

        function deleteItem(id) {
            Swal.fire({
                title: 'Xác nhận xóa',
                text: 'Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "{{ route('api.cart.delete') }}",
                        data: {
                            id: id,
                        },
                        dataType: "Json",
                        success: function(response) {
                            if (response.success) {
                                toastr.success('Sản phẩm đã được xóa khỏi giỏ hàng!');
                                getCart();
                            } else {
                                toastr.warn('Đã có lỗi xảy ra!');
                            }
                        },
                    });
                }
            })
        }
    </script>
    <script>
        $(document).ready(function() {
            $('#apply_voucher').on('click', function() {
                let voucher = $('#voucher').val();
                let totalCart = unformatCurrency($('#total_cart_value').html())

                $("input[name='voucher']").val(voucher)

                $.ajax({
                    type: "POST",
                    url: "{{ route('api.voucher.apply') }}",
                    data: {
                        voucher: voucher,
                        total: totalCart
                    },
                    dataType: "Json",
                    success: function(response) {
                        if (response.type == 'success') {
                            toastr.success(response.message);
                            $('#voucher_value').html(formatCurrency(response.value));
                            $("input[name='voucher_value']").val(response.value)

                            updateSubTotal();
                        }
                        if (response.type == 'warning') {
                            toastr.warning(response.message);
                        }
                        if (response.type == 'error') {
                            toastr.error(response.message);
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $(document).on('click', '#proceed_to_checkout', function() {
            let cartItems = [];
            // let cartTotal = 0;
            // let voucher = $('#voucher').val();
            // let voucherValue = $('#voucher_value').text() ? unformatCurrency($('#voucher_value').text()) : 0;
            // let subtotal = unformatCurrency($('#subtotal').text());

            $('#cart_item tr').each(function() {
                let productId = $(this).find('.quantity-input').data('product-id');
                let quantity = $(this).find('.quantity-input').val();
                cartItems.push({
                    id: productId,
                    quantity: quantity
                });
                let productPrice = unformatCurrency($(this).find('.subtotal').text());
                cartTotal += productPrice;
            });

            if (cartItems.length === 0) {
                toastr.warning('Giỏ hàng của bạn đang trống!');
                return;
            }


            $("input[name='cart_items']").val(JSON.stringify(cartItems));

            $("#getCheckOut").submit();
        });
    </script>
@endsection
