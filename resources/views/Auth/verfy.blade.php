@extends('Layout.auth')
@section('content')
    <div class="login-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center g-4">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Verfy Your Email</h3>
                            <p>New Member? <a href="{{ route('register') }}">sign-up here</a></p>
                        </div>
                        <form id="verfy" action="{{ route('verfy.again') }}" class="w-100" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-inner">
                                        <label>Enter Your Email <span class="text-danger">*</span></label>
                                        <input name="email" type="text" placeholder="Enter Your Email" maxlength="155">
                                        <p class="err_email text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            <button id="submitButton" class="account-btn">Submit</button>
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
            $("#verfy").on("submit", function(e) {
                e.preventDefault();
                let loading = `<div class="rotating"></div>`;
                $("#submitButton").html(loading);
                let data = {
                    email: $("input[name='email']").val().trim(),
                }
                let actionUrl = $(this).attr('action')
                $.ajax({
                    type: "POST",
                    url: actionUrl,
                    data: data,
                    dataType: "Json",
                    success: function(response) {
                        $(".err_email").text('');
                        if (response.status == 'validate') {
                            $(".err_email").text(response.message.email[0]);
                        }
                        if (response.status == 'verified') {
                            toastr.info(response.message);
                            setTimeout(function() {
                                window.location.href = "{{ route('login') }}";
                            }, 2000);
                        }
                        if (response.status == 'success') {
                            toastr.success(response.message)
                        }
                        if (response.status == 'warning') {
                            toastr.warning(response.message)
                        }
                    },
                    error: function(xhr, status, error) {
                        toastr.error('Đã xảy ra lỗi khi gửi yêu cầu. Vui lòng thử lại sau.');
                    },
                    complete: function() {
                        $("#submitButton").text('Submit');
                    }
                });
            });
        });
    </script>
@endsection
