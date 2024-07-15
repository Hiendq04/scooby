@extends('Layout.client')
@section('content')
    <div class="gallery-pages pt-120 mb-120">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 mb--70 d-flex justify-content-center">
                    <div class="filters filter-button-group">
                        <ul class="d-flex justify-content-center flex-wrap">
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".food" class>Grooming</li>
                            <li data-filter=".privateevent" class>Walking</li>
                            <li data-filter=".interior" class>Day Care</li>
                            <li data-filter=".eatingplace" class>Boarding</li>
                            <li data-filter=".traditions" class>veterinary</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="row grid g-4">
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item food">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-01.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-01.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item privateevent">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-02.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-02.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item interior">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-03.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-03.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item eatingplace">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-04.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-04.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item traditions">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-05.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-05.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item food">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-06.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-06.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item privateevent">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-07.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-07.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item interior">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-08.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-08.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item eatingplace">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-09.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-09.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item eatingplace">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-010.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-010.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item eatingplace">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-011.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-011.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 grid-item eatingplace">
                            <a href="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-big-img-012.png"
                                data-fancybox="gallery" class="gallery2-img">
                                <div class="gallery-img">
                                    <img class="img-fluid"
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/gallery/3col-gallery-012.png"
                                        alt>
                                    <div class="overlay">
                                        <div class="zoom-icon">
                                            <i class="bi bi-zoom-in"></i>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="load-more-btn">
                        <a class="primary-btn1" href="#">Load More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
