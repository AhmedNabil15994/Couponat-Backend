<div class="card border-0">
    <a href="{{ route('frontend.offers.show',['id'=>$offer->id]) }}" class="image-cotainer">
        <img src="{{asset($offer->main_image)}}" class="card-img-top rounded" alt="main_image">
        <div class="overlay"></div>
        @if($offer->quantity == 0)
        <div class="sold-out" style="background-image: url('{{asset('frontend/assets/images/soldOut.png')}}')"></div>
        @endif
    </a>
    @auth
        <a href="{{ route('frontend.offers.toggleFavorite',['id'=>$offer->id]) }}" class="like-btn">
            <i class="bi bi-heart-fill" style="{{$offer->is_favorite ? 'color:red;' : 'color:white'}}"></i>
{{--            @if($offer->is_favorite)--}}
{{--                <i class="bi bi-x-circle"></i>--}}
{{--            @endif--}}
        </a>
    @endauth
    @if($offer->quantity == 0)
{{--        <span class="label out_of_stock label-danger">{{__('apps::frontend.out_of_stock')}}</span>--}}
    @endif
    <div class="card-body">
        <a href="{{ route('frontend.offers.show',['id'=>$offer->id]) }}" class="card-title">
            {{$offer->title}}
        </a>
        <p class="card-text">
            {{$offer->discount_desc}}
        </p>
    </div>
</div>
