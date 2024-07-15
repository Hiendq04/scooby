@extends('Layout.client')
@section('content')
    <div class="services-details-area pt-120 mb-120">
        <div class="container">
            <div class="row g-lg-4 gy-5 mb-120">
                <div class="col-lg-7">
                    <div class="tab-content tab-content1" id="v-pills-tabContent">
                        <div class="tab-pane fade active show" id="v-pills-img1" role="tabpanel"
                            aria-labelledby="v-pills-img1-tab">
                            <img class="img-fluid"
                                src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-big-01.png" alt>
                        </div>
                        <div class="tab-pane fade" id="v-pills-img2" role="tabpanel" aria-labelledby="v-pills-img2-tab">
                            <img class="img-fluid"
                                src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-big-02.png" alt>
                        </div>
                        <div class="tab-pane fade" id="v-pills-img3" role="tabpanel" aria-labelledby="v-pills-img3-tab">
                            <img class="img-fluid"
                                src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-big-03.png" alt>
                        </div>
                        <div class="tab-pane fade" id="v-pills-img4" role="tabpanel" aria-labelledby="v-pills-img4-tab">
                            <img class="img-fluid"
                                src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-big-04.png" alt>
                        </div>
                        <div class="tab-pane fade" id="v-pills-img5" role="tabpanel" aria-labelledby="v-pills-img5-tab">
                            <img class="img-fluid"
                                src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-big-05.png" alt>
                        </div>
                    </div>
                    <div class="nav nav1 nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-img1-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-img1" type="button" role="tab" aria-controls="v-pills-img1"
                            aria-selected="true">
                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-sm-01.png" alt>
                        </button>
                        <button class="nav-link" id="v-pills-img2-tab" data-bs-toggle="pill" data-bs-target="#v-pills-img2"
                            type="button" role="tab" aria-controls="v-pills-img2" aria-selected="false">
                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-sm-02.png" alt>
                        </button>
                        <button class="nav-link" id="v-pills-img3-tab" data-bs-toggle="pill" data-bs-target="#v-pills-img3"
                            type="button" role="tab" aria-controls="v-pills-img3" aria-selected="false">
                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-sm-03.png" alt>
                        </button>
                        <button class="nav-link" id="v-pills-img4-tab" data-bs-toggle="pill" data-bs-target="#v-pills-img4"
                            type="button" role="tab" aria-controls="v-pills-img4" aria-selected="false">
                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-sm-04.png" alt>
                        </button>
                        <button class="nav-link" id="v-pills-img5-tab" data-bs-toggle="pill" data-bs-target="#v-pills-img5"
                            type="button" role="tab" aria-controls="v-pills-img5" aria-selected="false">
                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/card-sm-05.png" alt>
                        </button>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="services-datails-content">
                        <div class="banner-title">
                            <h2>Day Care</h2>
                            <div class="currency">
                                <h5>$50.00-$80.00</h5>
                            </div>
                        </div>
                        <div class="service-area">
                            <form>
                                <div class="row g-4">
                                    <div class="col-lg-12">
                                        <div class="form-inner">
                                            <label>Duration</label>
                                            <select id="duration">
                                                <option>Choose an option</option>
                                                <option>Full Day (over 5 hrs)</option>
                                                <option>Half Day (under 5 hrs)</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-inner date">
                                            <label>Date</label>
                                            <input autocomplete="off" type="text" id="datepicker"
                                                placeholder="DD/MM/YYYY">
                                        </div>
                                    </div>
                                    <div
                                        class="shop-quantity d-flex flex-wrap align-items-center justify-content-start mb-20">
                                        <div class="quantity d-flex align-items-center">
                                            <div class="quantity-nav nice-number d-flex align-items-center">
                                                <input type="number" value="1" min="1">
                                            </div>
                                        </div>
                                        <a href="https://demo.egenslab.com/html/scooby/preview/cart.html"
                                            class="primary-btn3">Add to cart</a>
                                    </div>
                                    <div class="pyment-method">
                                        <h6>Guaranted Safe Checkout</h6>
                                        <ul>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/visa2.svg"
                                                    alt></li>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/amex.svg"
                                                    alt></li>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/discover.svg"
                                                    alt></li>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/mastercard.svg"
                                                    alt></li>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/stripe.svg"
                                                    alt></li>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/paypal.svg"
                                                    alt></li>
                                            <li><img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/pay.svg"
                                                    alt></li>
                                        </ul>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-120">
                <div class="col-lg-12">
                    <div class="nav nav2 nav  nav-pills" id="v-pills-tab2" role="tablist" aria-orientation="vertical">
                        <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home"
                            aria-selected="false">Description </button>
                        <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-profile" type="button" role="tab"
                            aria-controls="v-pills-profile" aria-selected="true">Processes</button>
                        <button class="nav-link" id="v-pills-common-tab" data-bs-toggle="pill"
                            data-bs-target="#v-pills-common" type="button" role="tab"
                            aria-controls="v-pills-common" aria-selected="true">Review</button>
                    </div>
                    <div class="tab-content tab-content2" id="v-pills-tabContent2">
                        <div class="tab-pane fade active show" id="v-pills-home" role="tabpanel"
                            aria-labelledby="v-pills-home-tab">
                            <div class="description">
                                <p class="para-2 mb-3">Our pet care service provides various forms of care for pets,
                                    including feeding, exercise, grooming, and overall well-being. This type of service can
                                    be provided in the pet owner's home or at a facility, such as a pet hotel or boarding
                                    kennel. We also offer additional services such as training, transportation, and medical
                                    care. We are specialize in caring for a specific type of animal, such as cats or dogs,
                                    while others may be able to care for a variety of different types of pets. The level of
                                    our care and type of services offered will vary depending on the specific pet care
                                    service.</p>
                                <p class="para-2">This Pet care services can be a great option for busy pet owners who are
                                    unable to provide the necessary care for their pets due to work or other commitments.
                                    They can also be a helpful resource for pet owners who are traveling and need someone to
                                    look after their pets while they are away.</p>
                            </div>
                            <div class="row g-lg-4 gy-5">
                                <div class="col-lg-6">
                                    <p class="para-2 mb-2">There is often ask some questions about the pet care service and
                                        we always try to give all the answer of their questions. Before taking services it
                                        is important to know about the service process and its advantages or disadvantages.
                                        Here is some questions and answers we set as standard.</p>
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapseOne" aria-expanded="true"
                                                    aria-controls="collapseOne">
                                                    01. What services are offered?
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show"
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Pet care services can include dog walking, feeding and watering,
                                                    administering medication, providing companionship and playtime, and
                                                    basic grooming.</div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingTwo">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                                    aria-expanded="false" aria-controls="collapseTwo">
                                                    02. How do I choose a pet care service?
                                                </button>
                                            </h2>
                                            <div id="collapseTwo" class="accordion-collapse collapse"
                                                aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Some things to consider when choosing a pet care service include the
                                                    type of service you need, the cost, the availability of the service.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingThree">
                                                <button class="accordion-button collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                                    aria-expanded="false" aria-controls="collapseThree">
                                                    03. Is it safe to leave my pet with a pet care service?
                                                </button>
                                            </h2>
                                            <div id="collapseThree" class="accordion-collapse collapse"
                                                aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    Pet care services should be able to provide a safe and comfortable
                                                    environment for your pet.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="services-dt-img">
                                        <img class="img-fluid"
                                            src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/services-dt-immg.png"
                                            alt>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel"
                            aria-labelledby="v-pills-profile-tab">
                            <div class="description">
                                <p class="para-2 mb-3">Choosing a pet care service, it is important to do your research and
                                    select a reputable provider that has experience and a good track record. You should also
                                    discuss your pet's needs and any special instructions with the provider to ensure that
                                    your pet will receive the best possible care.</p>
                                <ul>
                                    <li><strong>Boarding:</strong> This is when you leave your pet at a kennel or other
                                        facility while you are away. Boarding facilities typically offer basic care such as
                                        feeding, watering, and exercise, as well as additional services like grooming and
                                        training.</li>
                                    <li><strong>Daycare:</strong> Daycare is a service that provides care for your pet while
                                        you are at work or otherwise busy. Daycare facilities typically offer playtime,
                                        socialization, and basic care such as feeding and watering.</li>
                                    <li><strong>Grooming:</strong> Grooming services can help keep your pet clean and
                                        well-groomed. This can include bathing, clipping nails, and brushing fur.</li>
                                    <li><strong>Training:</strong> Pet training services can help teach your pet basic
                                        obedience skills or help with behavioral issues.</li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="v-pills-common" role="tabpanel"
                            aria-labelledby="v-pills-common-tab">
                            <div class="reviews-area">
                                <div class="row g-lg-4 gy-5">
                                    <div class="col-lg-8">
                                        <div class="number-of-review">
                                            <h3>Review (02) :</h3>
                                        </div>
                                        <div class="review-list-area">
                                            <ul class="review-list">
                                                <li>
                                                    <div
                                                        class="single-review d-flex justify-content-between flex-md-nowrap flex-wrap">
                                                        <div class="review-image">
                                                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/review-img-1.png"
                                                                alt="image">
                                                        </div>
                                                        <div class="review-content">
                                                            <div class="c-header d-flex align-items-center">
                                                                <div class="review-meta">
                                                                    <h5 class="mb-0"><a href="#">Rocky Mike ,</a>
                                                                    </h5>
                                                                    <div class="c-date">06 july,2022</div>
                                                                </div>
                                                                <div class="replay-btn">
                                                                    <a href="#"><i class="bi bi-reply"></i>Reply</a>
                                                                </div>
                                                            </div>
                                                            <ul class="product-review">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                            <div class="c-body">
                                                                <p>I must explain to you how all this mistaken idea of
                                                                    denouncing pleasure and praising pain was born and I
                                                                    will give you a complete account. </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div
                                                        class="single-review d-flex justify-content-between flex-md-nowrap flex-wrap">
                                                        <div class="review-image">
                                                            <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/review-img-3.png"
                                                                alt="image">
                                                        </div>
                                                        <div class="review-content">
                                                            <div class="c-header d-flex align-items-center">
                                                                <div class="review-meta">
                                                                    <h5 class="mb-0"><a href="#">Rony Jhon ,</a>
                                                                    </h5>
                                                                    <div class="c-date">07 july,2022</div>
                                                                </div>
                                                                <div class="replay-btn">
                                                                    <a href="#"><i class="bi bi-reply"></i>Reply</a>
                                                                </div>
                                                            </div>
                                                            <ul class="product-review">
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                                <li><i class="bi bi-star-fill"></i></li>
                                                            </ul>
                                                            <div class="c-body">
                                                                <p>I must explain to you how all this mistaken idea of
                                                                    denouncing pleasure and praising pain was born and I
                                                                    will give you a complete account. </p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="review-form">
                                            <div class="number-of-review">
                                                <h3>Leave A Reply</h3>
                                            </div>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-inner mb-20">
                                                            <input type="text" placeholder="Name*" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-inner mb-20">
                                                            <input type="email" placeholder="Email*" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-inner mb-10">
                                                            <textarea placeholder="Message..."></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-inner2 mb-30">
                                                            <div class="review-rate-area">
                                                                <p>Your Rating</p>
                                                                <div class="rate">
                                                                    <input type="radio" id="star5" name="rate"
                                                                        value="5">
                                                                    <label for="star5" title="text">5 stars</label>
                                                                    <input type="radio" id="star4" name="rate"
                                                                        value="4">
                                                                    <label for="star4" title="text">4 stars</label>
                                                                    <input type="radio" id="star3" name="rate"
                                                                        value="3">
                                                                    <label for="star3" title="text">3 stars</label>
                                                                    <input type="radio" id="star2" name="rate"
                                                                        value="2">
                                                                    <label for="star2" title="text">2 stars</label>
                                                                    <input type="radio" id="star1" name="rate"
                                                                        value="1">
                                                                    <label for="star1" title="text">1 star</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-inner two">
                                                            <button class="primary-btn3 btn-lg" type="submit">Post
                                                                Comment</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div
                    class="col-lg-12 d-flex flex-wrap align-items-center justify-content-sm-between justify-content-start gap-4 mb-60">
                    <div class="inner-section-title">
                        <h2>Other Services</h2>
                    </div>
                    <div class="swiper-btn-wrap d-flex align-items-center">
                        <div class="slider-btn prev-btn-1">
                            <i class="bi bi-arrow-left"></i>
                        </div>
                        <div class="slider-btn next-btn-1">
                            <i class="bi bi-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="swiper home1-services-slider">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="services-card1">
                                <img class="services-card-vec"
                                    src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/services-card-vec.png"
                                    alt>
                                <div class="icon">
                                    <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/daycare-center2.svg"
                                        alt>
                                </div>
                                <div class="content">
                                    <h3><a href="https://demo.egenslab.com/html/scooby/preview/service-details.html">Daycare
                                        </a></h3>
                                    <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>
                                </div>
                                <a class="more-btn"
                                    href="https://demo.egenslab.com/html/scooby/preview/service-details.html">More
                                    Details<img
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/btn-arrow1.svg"
                                        alt></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="services-card1 two">
                                <img class="services-card-vec"
                                    src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/services-card-vec.png"
                                    alt>
                                <div class="icon">
                                    <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/grooming2.svg"
                                        alt>
                                </div>
                                <div class="content">
                                    <h3><a href="https://demo.egenslab.com/html/scooby/preview/service-details.html">Grooming
                                        </a></h3>
                                    <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>
                                </div>
                                <a class="more-btn"
                                    href="https://demo.egenslab.com/html/scooby/preview/service-details.html">More
                                    Details<img
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/btn-arrow1.svg"
                                        alt></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="services-card1 three">
                                <img class="services-card-vec"
                                    src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/services-card-vec.png"
                                    alt>
                                <div class="icon">
                                    <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/boarding2.svg"
                                        alt>
                                </div>
                                <div class="content">
                                    <h3><a
                                            href="https://demo.egenslab.com/html/scooby/preview/service-details.html">Boarding</a>
                                    </h3>
                                    <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>
                                </div>
                                <a class="more-btn"
                                    href="https://demo.egenslab.com/html/scooby/preview/service-details.html">More
                                    Details<img
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/btn-arrow1.svg"
                                        alt></a>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="services-card1 four">
                                <img class="services-card-vec"
                                    src="https://demo.egenslab.com/html/scooby/preview/assets/images/bg/services-card-vec.png"
                                    alt>
                                <div class="icon">
                                    <img src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/veterinary2.svg"
                                        alt>
                                </div>
                                <div class="content">
                                    <h3><a
                                            href="https://demo.egenslab.com/html/scooby/preview/service-details.html">veterinary</a>
                                    </h3>
                                    <p>Pellentesque maximus augue orciquista ut aliquet risus In hac habitasse.</p>
                                </div>
                                <a class="more-btn"
                                    href="https://demo.egenslab.com/html/scooby/preview/service-details.html">More
                                    Details<img
                                        src="https://demo.egenslab.com/html/scooby/preview/assets/images/icon/btn-arrow1.svg"
                                        alt></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
