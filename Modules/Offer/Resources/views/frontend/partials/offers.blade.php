@foreach($offers as $key => $offer)
    <div class="grid-item col-lg-4 col-md-4 col-sm-6 f1 f11 f21 f31 f41 f51">
        @include('offer::frontend.partials.offer-card',['offer'=>$offer])
    </div>
@endforeach
