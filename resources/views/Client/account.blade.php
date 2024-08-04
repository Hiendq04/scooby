@extends('Layout.client')
@section('content')
    <div class="signup-section pt-120 pb-120">
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-xl-6 col-lg-8 col-md-10">
                    <div class="form-wrapper wow fadeInUp" data-wow-duration="1.5s" data-wow-delay=".2s">
                        <div class="form-title">
                            <h3>Account Info</h3>
                        </div>
                        <form id="register" class="w-100" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-inner">
                                        <label>Frist Name</label>
                                        <input name="first_name" value="{{ $account->first_name }}" type="text"
                                            placeholder="Frist Name" maxlength="30">
                                        <p class="error err_first_name text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-inner">
                                        <label>Last Name</label>
                                        <input name="last_name" value="{{ $account->last_name }}" type="text"
                                            placeholder="Last Name" maxlength="30">
                                        <p class="error err_last_name text-danger"></p>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-inner">
                                        <label>Enter Your Email</label>
                                        <input name="email" value="{{ $account->email }}" type="text"
                                            placeholder="Enter Your Email" maxlength="155">
                                        <p class="error err_email text-danger"></p>
                                    </div>
                                </div>
                            </div>
                            {{-- <button type="submit" id="submitButton" class="account-btn">Create Account</button> --}}
                        </form>
                        @if (Auth::user()->role == 'admin')
                            <div class="d-flex justify-center">
                                <a class="btn btn-warning col-5" href="{{ route('admin.dashboard') }}">Admin</a>
                                <div class="col-2"></div>
                                <a class="btn btn-danger col-5" href="{{ route('logout') }}"><i
                                        class="bi bi-box-arrow-right"></i></a>
                            </div>
                        @else
                            <a class="btn btn-danger col-12" href="{{ route('logout') }}"><i
                                    class="bi bi-box-arrow-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // let apiUrl = "{{ route('api.account.info') }}";

        // $.ajax({
        //     type: "GET",
        //     url: apiUrl,
        //     dataType: "Json",
        //     success: function (response) {
        //         console.log(response);
        //     }
        // });
    </script>
@endsection
