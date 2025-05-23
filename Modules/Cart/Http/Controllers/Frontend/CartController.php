<?php

namespace Modules\Cart\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cart\Traits\CartTrait;
use Modules\Cart\Http\Requests\Frontend\CartRequest;
use Modules\Offer\Entities\Offer;
use Modules\Offer\Repositories\Frontend\OfferRepository;
use Modules\Offer\Transformers\Dashboard\OfferResource;
use Modules\Package\Transformers\Frontend\CartPackageResource;

class CartController extends Controller
{
    use CartTrait;

    protected $offer;

    public function __construct(OfferRepository $offer)
    {
        $this->offer = $offer;
    }

    public function index(Request $request)
    {
        $items = $this->getCartContent();
        return view('cart::frontend.show', compact('items'));
    }

    public function add(CartRequest $request, $type, $id)
    {
        $item = $this->getItem($id, $type);

        if (is_null($item)) {
            return redirect()->route('frontend.cart.index')->with([
                'msg'     => 'offer not found',
                'status'   => 'danger',
            ]);
        }
        $this->addToCart($item, $type, $request->qty);
        if(isset($request->replace)){
            $this->removeItem($id, $type);
            $this->addToCart($item, $type, $request->qty);
        }
        $item = $this->getCartContent();

        session()->forget('order_id');
        return redirect()->back()->with([
            'msg'     => __('cart::frontend.message.add_to_cart'),
            'status'   => 'success',
        ]);
    }
    private function  getItem($id, $type)
    {
        try {
            switch($type){
                case 'offer':
                    $model = $this->offer->getOffer($id);
                    $item = !is_null($model) && $model->quantity > 0 ? (new OfferResource($model))->jsonSerialize() : null;
                    break;
            }
            return $item;
        } catch (\Throwable $th) {
            return redirect()->back();
        }
    }
    public function remove($type, $id)
    {
        $this->removeItem($id, $type);
        $item = $this->getCartContent();
        session()->forget('order_id');
        return redirect()->route('frontend.cart.index')->with([
            'msg' => __('cart::frontend.message.remove_from_cart'),
            'alert' => 'success',
            'courses' => $item,
        ]);
    }

    public function clear()
    {
        $this->clearCart();
        $items = $this->getCartContent();
        return redirect()->route('frontend.cart.index')->with([
            'message' => __('cart::frontend.message.clear_cart'),
            'alert' => 'success',
            'courses' => $items,
        ]);
    }

    public function checkout(){
        session()->forget('discount');
        $items = $this->getCartContent();
        return view('cart::frontend.checkout', compact('items'));
    }
}
