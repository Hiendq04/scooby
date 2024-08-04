@extends('Layout.client')
@section('content')
    @php
        $formatter = new \NumberFormatter('vi_VN', \NumberFormatter::CURRENCY);
        $productJson = json_encode($products);
    @endphp
    <form action="{{ route('place.order') }}" method="POST">
        @csrf
        <div class="checkout-section pt-120 pb-120">
            <div class="container">
                <div class="row g-4">
                    <div class="col-lg-7">
                        <div class="form-wrap box--shadow mb-30">
                            <h4 class="title-25 mb-20">Billing Details</h4>
                            <span>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label>First Name</label>
                                            <input value="{{ old('first_name') }}" type="text" name="first_name"
                                                placeholder="Your first name">
                                            @error('first_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-inner">
                                            <label>Last Name</label>
                                            <input value="{{ old('last_name') }}" type="text" name="last_name"
                                                placeholder="Your last name">
                                            @error('last_name')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-inner">
                                            <label>Street Address</label>
                                            <input value="{{ old('shipping_address') }}" type="text"
                                                name="shipping_address" placeholder="House and street name">
                                            @error('shipping_address')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-inner">
                                            <label>Additional Information</label>
                                            <input type="text" value="+84{{ old('phone') }}" name="phone"
                                                placeholder="Your Phone Number">
                                            @error('phone')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-inner">
                                            <input value="{{ Auth::user()->email }}" type="email" name="email"
                                                placeholder="Your Email Address">
                                            @error('email')
                                                <p class="text-danger">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="form-inner">
                                            <textarea name="note" placeholder="Order Notes (Optional)" rows="6">{{ old('note') }}</textarea>
                                        </div>
                                        @error('note')
                                            <p class="text-danger">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </span>
                        </div>
                    </div>
                    <aside class="col-lg-5">
                        <div class="added-product-summary mb-30">
                            <h5 class="title-25 checkout-title">
                                Order Summary
                            </h5>
                            <ul class="added-products">
                                @foreach ($products as $product)
                                    <li class="single-product d-flex justify-content-start">
                                        <div class="product-img">
                                            @if (Storage::disk('public')->exists($product->image))
                                                <img style="max-height: 100px; max-width: 40px;"
                                                    src="{{ Storage::url($product->image) }}" alt>
                                            @else
                                                <img style="max-height: 100px; max-width: 40px;"
                                                    src="{{ $product->image }}" alt>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <h5 class="product-title"><span href="">{{ $product->name }}</span></h5>
                                            <div class="product-total d-flex align-items-center">
                                                <div class="quantity">
                                                    <div class="quantity d-flex align-items-center">
                                                        <div class="quantity-nav nice-number d-flex align-items-center">
                                                            <input disabled type="text"
                                                                value="Count: {{ $product->quantity_cart }}"
                                                                min="1">
                                                        </div>
                                                    </div>
                                                </div>
                                                <strong> <i class="bi bi-x-lg px-2"></i>
                                                    <span
                                                        class="product-price">{{ $formatter->format($product->price_sale) }}</span>
                                                </strong>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="summery-card cost-summery mb-30">
                            <table class="table cost-summery-table">
                                <thead>
                                    <tr>
                                        <th>Total</th>
                                        <th id="total"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="tax">Voucher</td>
                                        <td>{{ $voucher ? $voucher->code : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Voucher Value</td>
                                        <td id="voucher_value">0 ₫</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="summery-card total-cost mb-30">
                            <table class="table cost-summery-table total-cost">
                                <thead>
                                    <tr>
                                        <th>Subtotal</th>
                                        <th id="subtotal"></th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                        <div class="payment-form">
                            <div class="payment-methods mb-50">
                                <div class="form-check payment-check">
                                    <input {{ old('payment_method') == 'payments' ? 'checked' : '' }} name="payment_method"
                                        value="payments" class="form-check-input" type="radio" id="flexRadioDefault1">
                                    <label class="form-check-label" for="flexRadioDefault1">
                                        Check payments
                                    </label>
                                    <p class="para">Please send a check to Store Name, Store Street, Store Town, Store
                                        State
                                        /
                                        County, Store Postcode.</p>
                                </div>
                                <div class="form-check payment-check">
                                    <input {{ old('payment_method') == 'cod' ? 'checked' : '' }} name="payment_method"
                                        value="cod" class="form-check-input" type="radio" id="flexRadioDefault2"
                                        checked>
                                    <label class="form-check-label" for="flexRadioDefault2">
                                        Cash on delivery
                                    </label>
                                    <p class="para">Pay with cash upon delivery.</p>
                                </div>
                                <div class="form-check payment-check paypal d-flex flex-wrap align-items-center">
                                    <input {{ old('payment_method') == 'paypal' ? 'checked' : '' }} name="payment_method"
                                        value="paypal" class="form-check-input" type="radio" id="flexRadioDefault3">
                                    <label class="form-check-label" for="flexRadioDefault3">
                                        PayPal
                                    </label>
                                    <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/payonert.png"
                                        alt>
                                    <a href="#" class="about-paypal">What is PayPal</a>
                                </div>
                                <div class="payment-form-bottom d-flex align-items-start">
                                    <input {{ old('check') ? 'checked' : '' }} name="check" type="checkbox"
                                        id="terms">
                                    <label for="terms">I have read and agree to the website <br> <a
                                            href="#">Terms
                                            and
                                            conditions</a></label>
                                </div>
                            </div>
                            <div class="place-order-btn">
                                <button type="submit" class="primary-btn1 lg-btn">Place Order</button>
                            </div>
                            </d>
                    </aside>
                </div>
            </div>
        </div>
        <div class="d-none">
            <input type="text" name="voucher_id" value="{{ $voucher ? $voucher->id : '' }}">
            <input type="text" name="discounted_amount" value="{{ $voucher ? $voucher->value : 0 }}">
            <input type="text" name="original_amount" value="{{ $cart_total }}">
            <input type="text" name="total_amount" value="{{ $subtotal }}">
            <input type="text" name="products" value="{{ $productJson }}">
        </div>
    </form>
@endsection

@section('scripts')
    @if (
        !$errors->has('first_name') &&
            !$errors->has('last_name') &&
            !$errors->has('shipping_address') &&
            !$errors->has('phone') &&
            !$errors->has('email'))
        @error('payment_method')
            <script>
                toastr.warning('Vui lòng chọn phương thức thanh toán!');
            </script>
        @enderror
        @error('check')
            <script>
                toastr.warning('Vui lòng đồng ý với điều khoản và dịch vụ!');
            </script>
        @enderror
    @endif
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

        $('#total').html(formatCurrency({{ $cart_total }}));
        $('#voucher_value').html(formatCurrency({{ $voucher ? $voucher->value : 0 }}));
        $('#subtotal').html(formatCurrency({{ $subtotal }}));
    </script>
@endsection
