@extends('Layout.auth')
@section('content')
    <div class="signup-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Sign Up</h3>
                            <p>Do you already have an account? <a href="{{ route('login') }}">Log-in here</a></p>
                        </div>
                        <form id="register" action="{{ route('register.handle') }}" class="w-100" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-inner">
                                        <label>Frist Name <span class="text-danger">*</span></label>
                                        <input name="first_name" type="text" placeholder="Frist Name" maxlength="30">
                                        <p class="error err_first_name text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-inner">
                                        <label>Last Name <span class="text-danger">*</span></label>
                                        <input name="last_name" type="text" placeholder="Last Name" maxlength="30">
                                        <p class="error err_last_name text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label>Enter Your Email <span class="text-danger">*</span></label>
                                        <input name="email" type="text" placeholder="Enter Your Email" maxlength="155">
                                        <p class="error err_email text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label>Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password"
                                            placeholder="Create A Password" maxlength="50"/>
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                    <p class="error err_password text-danger"></p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label>Confirm Password <span class="text-danger">*</span></label>
                                        <input type="password" name="repassword" id="password2"
                                            placeholder="Confirm Password" maxlength="50"/>
                                        <i class="bi bi-eye-slash" id="togglePassword2"></i>
                                    </div>
                                    <p class="error err_repassword text-danger"></p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-agreement form-inner d-flex justify-content-between flex-wrap">
                                        <div class="form-group">
                                            <input name="check" type="checkbox" id="html">
                                            <label for="html">I agree to the <a href="#">Terms &
                                                    Policy</a></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- <button type="submit" class="account-btn">Create Account</button> --}}
                            <button type="submit" id="submitButton" class="account-btn">Create Account</button>
                        </form>
                        <div class="form-poicy-area">
                            <p>By clicking the "Create Account" button, you create a Cobiro account, and you agree to
                                Cobiro's
                                <a href="#">Terms & Conditions</a> & <a href="#">Privacy Policy.</a>
                            </p>
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
            $("#register").on("submit", function(e) {
                e.preventDefault();
                let loading = `<div class="rotating"></div>`;
                $("#submitButton").html(loading);
                let actionUrl = $(this).attr("action");
                let newData = {
                    first_name: $("input[name='first_name']").val().trim(),
                    last_name: $("input[name='last_name']").val().trim(),
                    email: $("input[name='email']").val().trim(),
                    password: $("input[name='password']").val().trim(),
                    repassword: $("input[name='repassword']").val().trim(),
                    check: $("input[name='check']").prop("checked") ? "true" : "false"
                };

                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: newData,
                    dataType: "JSON",
                    success: function(ress) {
                        $(".error").text('');
                        if (ress.status == 'validate') {
                            for (const key in ress.message) {
                                $("." + "err_" + key).text(ress.message[key][0]);
                            }
                        }
                        if (ress.status == 'check') {
                            toastr.warning(ress.message)
                        }
                        if (ress.status == 'success') {
                            toastr.success(ress.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Đã xảy ra lỗi khi gửi yêu cầu. Vui lòng thử lại sau.');
                    },
                    complete: function() {
                        $("#submitButton").text('Create Account');
                    }
                });
            });
        });
    </script>
@endsection
