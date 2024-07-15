@extends('Layout.client')
@section('content')
    <div class="error-page mb-120">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="error-wrapper">
                        <div class="error-img">
                            <img class="img-fluid"
                                src="{{asset('assets/images/bg/error-img.png')}}" alt />
                        </div>
                    </div>
                    <div class="error-content-area">
                        <h2>Something Went Wrong</h2>
                        <div class="error-btn">
                            <a class="primary-btn1" href="{{route('/')}}"><img
                                    src="{{asset('assets/images/icon/home-icon.svg')}}"
                                    alt />
                                Back to home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
