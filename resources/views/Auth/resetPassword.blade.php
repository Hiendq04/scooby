@extends('Layout.auth')
@section('content')
    <div class="signup-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Reset Password</h3>
                        </div>
                        <form id="resetPassword" action="{{ route('password.reset.handle') }}" class="w-100" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-12 d-none">
                                    <div class="form-inner">
                                        <input hidden name="email" type="text" value="{{ $email }}"
                                            maxlength="155">
                                    </div>
                                </div>
                                <div class="col-md-12 d-none">
                                    <div class="form-inner">
                                        <input hidden name="token" type="text" value="{{ $token }}"
                                            maxlength="155">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label>New Password <span class="text-danger">*</span></label>
                                        <input type="password" name="password" id="password"
                                            placeholder="Create A New Password" maxlength="50" />
                                        <i class="bi bi-eye-slash" id="togglePassword"></i>
                                    </div>
                                    <p class="error err_password text-danger"></p>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label>Confirm New Password <span class="text-danger">*</span></label>
                                        <input type="password" name="repassword" id="password2"
                                            placeholder="Confirm New Password" maxlength="50" />
                                        <i class="bi bi-eye-slash" id="togglePassword2"></i>
                                    </div>
                                    <p class="error err_repassword text-danger"></p>
                                </div>
                            </div>
                            {{-- <button type="submit" class="account-btn">Create Account</button> --}}
                            <button type="submit" id="submitButton" class="account-btn">Change Passsword</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $("#resetPassword").on("submit", function(e) {
                e.preventDefault();
                let loading = `<div class="rotating"></div>`;
                $("#submitButton").html(loading);
                let actionUrl = $(this).attr("action");
                let newData = {
                    email: $("input[name='email']").val().trim(),
                    token: $("input[name='token']").val().trim(),
                    password: $("input[name='password']").val().trim(),
                    repassword: $("input[name='repassword']").val().trim(),
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
                        if (ress.status == 'success') {
                            toastr.success(ress.message);
                            setTimeout(function() {
                                window.location.href = "{{ route('login') }}";
                            }, 2000)
                        }
                        if (ress.status == 'error') {
                            toastr.error(ress.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Đã xảy ra lỗi khi gửi yêu cầu. Vui lòng thử lại sau.');
                    },
                    complete: function() {
                        $("#submitButton").text('Change Passsword');
                    }
                });
            });
        });
    </script>
@endsection
