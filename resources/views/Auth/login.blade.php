@extends('Layout.auth')
@section('content')
    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Log In</h3>
                            <p>New Member? <a href="{{ route('register') }}">sign-up here</a></p>
                        </div>
                        <form class="w-100" id="login" method="POST">
                            {{-- action="{{ route('login.handle') }}" --}}
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Enter Your Email <span class="text-danger">*</span></label>
                                        <input type="text" name="email" placeholder="Enter Your Email" maxlength="155">
                                        <p class="err err_email text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password" placeholder="Password"
                                            maxlength="50" />
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                    <p class="err err_password text-danger"></p>
                                </div>
                                <div class="col-12">
                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                        <div class="form-group">
                                            <input checked disabled type="checkbox" id="html">
                                            <label for="html">I agree to the <a href="#">Terms &
                                                    Policy</a></label>
                                        </div>
                                        <a href="{{ route('forgot') }}" class="forgot-pass">Forgot Password</a>
                                    </div>
                                </div>
                            </div>
                            <button id="submitButton" type="submit" class="account-btn">Log in</button>
                        </form>
                        <div class="alternate-signup-box">
                            <h6>or log-in WITH</h6>
                            <div class="btn-group gap-4">
                                <a href="/auth/google/redirect" class="eg-btn google-btn d-flex align-items-center"><i
                                        class="bx bxl-google"></i><span>log-in with google</span></a>
                                <a href="/auth/github/redirect" class="eg-btn facebook-btn d-flex align-items-center"><i
                                        class="bx bxl-github"></i><span>log-in with github</span></a>
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
        $(document).ready(function() {
            $("#login").on("submit", function(e) {
                e.preventDefault();
                let check = true;
                let email = $("input[name='email']").val().trim();
                let password = $("input[name='password']").val().trim();
                $(".err").text('');
                if (!email) {
                    check = false;
                    $(".err_email").text("Vui lòng nhập email!");
                }
                if (!password) {
                    check = false;
                    $(".err_password").text("Vui lòng nhập mật khẩu!");
                }
                if (password.length > 0 && (password.length < 8 || password.length > 40)) {
                    check = false;
                    $(".err_password")
                        .text("Mật khẩu là chuỗi từ 8-40 ký tự!");
                }
                let regexEmail = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
                if (!regexEmail.test(email)) {
                    check = false;
                    $(".err_email").text("Vui lòng nhập địa email hợp lệ!");
                }
                if (check) {
                    $("#login").attr("action", "{{ route('login.handle') }}");
                    $("#login").unbind("submit").submit();
                }
            });
        });
    </script>
@endsection
