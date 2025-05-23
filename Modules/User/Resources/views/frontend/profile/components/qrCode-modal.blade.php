<!-- Modal -->
<style>
    svg{
        width: 100%;
        display: block;
    }
</style>
<div class="modal fade" id="qrCode{{$id}}" tabindex="-1" aria-labelledby="Sign in" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! $qr !!}
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('user::dashboard.users.create.form.offer',['offer'=>$item->offer->discount_desc])}}</p>
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('user::dashboard.users.create.form.code')}}: {{$item->code}}</p>
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('user::dashboard.users.create.form.name')}}: {{$item->order->user->name ?? ''}}</p>
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('apps::frontend.status')}}:
                    @if($item->expired_date < date('Y-m-d H:i:s'))
                        <span class="label label-success label-sm">{{__('apps::frontend.expired')}}</span>
                    @else
                        <span class="label label-danger label-sm">{{__('apps::frontend.valid')}}</span>
                    @endif
                </p>
                @if($item->expired_date > date('Y-m-d H:i:s'))
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('user::dashboard.users.create.form.expired_at')}}: {{$item->expired_date}}</p>
                @endif
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('apps::frontend.redeemed')}}:
                    @if($item->is_redeemed)
                        <span class="label label-success label-sm">{{__('apps::frontend.yes')}}</span>
                    @else
                        <span class="label label-danger label-sm">{{__('apps::frontend.no')}}</span>
                    @endif
                </p>
            @if($item->is_redeemed)
                <p class="text-{{locale() == 'ar' ? 'right' : 'left'}}" style="margin:10px 20px">{{__('apps::frontend.redeemed_at')}}: {{$date}}</p>
            @endif
            @if(auth()->check() &&
                ((auth()->user()->can(['seller_access']) && auth()->user()->seller_id == null) ||
                auth()->user()->can(['dashboard_access'])) &&
                $status && $item->expired_date > date('Y-m-d H:i:s') && !$item->is_redeemed)
                <a class="btn btn-primary btn-md" href="{{route('vendor.offers.redeem',['code'=>$item->code])}}">{{__('user::dashboard.redeem')}}</a>
            @endif
            </div>

        </div>
    </div>
</div>

