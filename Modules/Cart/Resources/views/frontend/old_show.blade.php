@extends('apps::frontend.layouts.app')
@section('title', __('cart::frontend.show.title') )
@section('content')
<div class="inner-page grey-bg">
  <div class="container">
    @include('apps::frontend.layouts._alerts')
    <div class="row">
      <div class="col-md-8">
        <div class="order-list">
          @foreach ($items as $item)
          @if($item->attributes->type == 'course')
          <div class="order-block course-block d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center">
              <div class="img-block">
                <img class="img-fluid" src="{{url($item->attributes->image) }}">
              </div>

              <div class="course-content">
                <h3><a href="{{route('frontend.courses.show',$item->attributes->product->slug)}}"> {{$item->attributes->product->title}}</a></h3>
                <a class="tutor-name" href="{{ route('frontend.trainers.show',$item->attributes->product->trainer->id) }}">By {{
                  $item->attributes->product->trainer->name }}</a>
                <span> {{ $item->price }} KWD</span>
              </div>
            </div>
            <div class="order-status">
              <a href="{{route('frontend.cart.remove',['course', $item->attributes->item_id])}}" class="remove-item "><i class="ti-close"></i></a>
            </div>
          </div>
          @endif
          @endforeach
        </div>
      </div>
      <div class="col-md-4">
        <div class="cart-summery">
          <h3>{{ __('Total') }}</h3>
          <span class="cart-price">{{ Cart::getTotal() }} KWD</span>
          {{-- <div class="cart-coupon d-flex align-items-center justify-content-between">
            <input type="text" placeholder="Coupone Code" />
            <button class="btn-add">{{ __('Add') }}</button>
          </div> --}}
          <br>
          @if(count(Cart::getContent()))
          <a class="btn main-custom-btn my-2" href="{{route('frontend.order.create.view')}}">{{__('cart::frontend.show.Checkout')}}</a>
          @else
          <button class="btn main-custom-btn my-2" disabled style="width: 100%">{{__('cart::frontend.show.Checkout')}}</button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>


@stop


@push('scripts')
<script>
  function EditQty(button, qtyId, action) {
            var form = $(button).closest('form');
            var qty = $('#' + qtyId);
            if (action == '+') {
                qty = parseInt(qty.val()) + 1;
            } else {

                qty = parseInt(qty.val()) - 1;
            }

            $.ajax({

                url: form.attr('action') + '?qty=' + qty,
                type: 'get',

                success: function (data) {

                },
            });
        }
</script>
@endpush
