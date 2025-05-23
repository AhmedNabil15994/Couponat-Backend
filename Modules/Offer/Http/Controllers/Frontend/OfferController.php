<?php

namespace Modules\Offer\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Kudashevs\ShareButtons\ShareButtons;
use Modules\Offer\Entities\Offer;
use Modules\Offer\Repositories\Frontend\OfferRepository;
use Modules\User\Repositories\Frontend\FavoriteRepository;

class OfferController extends Controller
{
    public function __construct(OfferRepository $offer,FavoriteRepository $fav)
    {
        $this->offer = $offer;
        $this->fav = $fav;
    }

    public function show($id){
        $offer   = $this->offer->getOffer($id);
        if(!$offer){
            abort(404);
        }
        $buttons = (new ShareButtons())->page(route('frontend.offers.show',['id'=>$offer->id]), $offer->title, [
            'class'=>'hidden'
            ])->copylink()->mailto()->telegram()->whatsapp()->reddit()->facebook()->twitter()->getRawLinks();

        $related = Offer::getRelated($offer);
        $related = count($related) ? $related : $this->offer->getActiveRelated($id);

        return view('offer::frontend.show',compact('offer','related','buttons'));
    }
    public function toggleFavorite($id){
        $user  = auth()->user();
        $offer   = $this->offer->getOffer($id);
        if(!$offer){
            abort(404);
        }
        $toggle =  $this->fav->toggleToCurrentUser($user, $id);
        return redirect()->back()->with(['status'=> 'success']);
    }
}
