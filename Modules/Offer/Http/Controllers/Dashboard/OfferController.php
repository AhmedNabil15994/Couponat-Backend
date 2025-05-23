<?php

namespace Modules\Offer\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Area\Entities\City;
use Modules\Area\Entities\State;
use Modules\Core\Traits\Dashboard\CrudDashboardController;
use Modules\Core\Traits\DataTable;
use Modules\Coupon\Http\Requests\Dashboard\CouponRequest;
use Modules\Coupon\Repositories\CouponRepository;
use Modules\Coupon\Transformers\Dashboard\CouponResource;
use Modules\Order\Entities\OrderItem;
use Modules\User\Entities\User;
use Spatie\MediaLibrary\MediaCollections\Models\Media;


class OfferController extends Controller
{
    use CrudDashboardController;

    public function extraData($model): array
    {
        return [
            'model' => $model,
            'sellers' => (new User())->getSellers(),
            'cities' => City::active()->get(),
            'states' => State::active()->get(),
        ];
    }

    public function searchAjax(Request $request) {
        return OrderItem::with('offer')->where('code','LIKE','%'.$request->q.'%')->get();
    }

    public function redeem($code){
        $offer = $this->repository->getByCode($code);
        if(!$offer){
            abort(404);
        }

        if($offer->is_redeemed){
            return redirect()->to(route('vendor.orders.show',['id'=>$offer->order_id]))->withErrors(__('user::dashboard.redeemed_before'));
        }

        $offer->is_redeemed = 1;
        $offer->redeemed_at = date('Y-m-d H:i:s');
        $offer->save();

        return redirect()->to(route('vendor.offers.index'))->with([
            'msg' => __('user::dashboard.redeemed'),
        ]);
    }

    public function copy($id)
    {
        $model = $this->repository->findById($id);
        $model->load('offersCategories');

        $newModel = $model->replicate();
        $newModel->push();

        foreach($model->getRelations() as $relation => $items){
            foreach($items as $item){
                unset($item->id);
                $newModel->{$relation}()->create($item->toArray());
            }
        }

        return redirect()->to(route('dashboard.offers.edit',$newModel->id));
    }

    public function deleteMediaFiles(Request $request) {
        Media::whereIn('id',$request->id)->delete();
        return response()->json([true,__('apps::dashboard.messages.deleted')]);
    }
}
