@extends('apps::Frontend.layouts.app')

@section('content')
    <div class="container-fluid">
        <section class="item-details">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <!-- title -->
                        <div class="item-info coup-info">
                            <div class="item-title-info bb-1">
                                <div class="row">

                                    <div class="col-md-4 col-12">
                                        <a class="ads-block" href='#'>
                                            <div class="img-block">
                                                <img class="img-fluid" src="assets/images/barcode.jpg" alt="" />
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="item-details bb-1 py-3">
                            <div class="discription-box">
                                <p>
                                    Visit Wahaj Boulevard Hotel and enjoy the Delightful Breakfast buffet and indulge in the rich fresh wide range of tasty Foods
                                </p>
                            </div>
                        </div>
                        <!-- feature -->
                        <div class="item-feature-info bb-1 py-3">
                            <h3 class="h4">
                                Details:
                            </h3>

                            <ul class="list-unstyled feature-list">
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0"> Advanced reservation is required Advanced reservation is required Advanced reservation is required Advanced reservation is required. </p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Offer is valid on Friday only</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Dinner Buffet time: from 7.00pm - 11:00pm at Together & Co restaurant.</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Kids under 6 years eat for free ( maximum 2 kids )</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Kids between 6 & 12 years old, charged 50%</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Offer include soft drinks and mineral water only</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Can't be used with another offer</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Each coupon is valid for 1 person</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">Can't be redeemed for cash</p>
                                </li>
                                <li class="feature-item">
                                    <i class="bi bi-chevron-double-right"></i>
                                    <p class="mb-0">No refund</p>
                                </li>
                            </ul>
                        </div>
                        <!-- map -->
                        <div class="item-lcation py-3">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d1815.270509755781!2d39.571912!3d24.501355!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x15bdbed6c72fb5c9%3A0x878f97d763f83401!2z2KfZhNi32YrYp9ixINmF2K3Yp9mF2YjZhiDZiNmF2LPYqti02KfYsdmI2YY!5e0!3m2!1sen!2sus!4v1689525519740!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                    <!-- Stiky colum -->
                    <div class="col-md-4">
                        <div class="sticky-top">
                            <div class="stiky-box p-3">
                                <div class="check-form">
                                    <a href="tel:0000" class="btn btn-green btn-block my-2">Call</a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </section>

    </div>
@endsection
