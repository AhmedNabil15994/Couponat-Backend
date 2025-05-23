<?php

namespace Modules\Category\Http\Controllers\Frontend;

use Illuminate\Routing\Controller;
use Modules\Category\Entities\Category;
use Modules\Offer\Entities\Offer;
use Modules\Offer\Repositories\Frontend\OfferRepository;
use Illuminate\Http\Request;
class ShowCategoryController extends Controller
{
    public function __construct(OfferRepository $offer,Category $category)
    {
        $this->offer = $offer;
        $this->category = $category;
    }
    public function index(Request $request){
        $offers = $this->offer->getAll($request);
        return view('apps::Frontend.index',compact('offers'));
    }
    public function show(Category $category,Request $request)
    {
        $ids_arr[$category->id] = $category->id;
        $ids = $category->children()->active()->orderBy('order','desc')->pluck('id');
        $ids = reset($ids);
        $ids_arr = !count($ids) ? [$category->id] : array_merge($ids_arr,$ids);
        $arr =[];

        foreach ($ids_arr as $category_id) {
            $newCategory = Category::find($category_id);
            $arr[$category_id] = [
                'offers'    => $newCategory->validOffers()->orderBy('order','desc')->paginate(env('PAGINATION_COUNT')) ?? [],
                'banner'    => $newCategory->getBanner($newCategory->id),
            ];
        }

        if($request->ajax()){
            return [
                'offers'    => view('offer::frontend.partials.offers',['offers' => $arr[$category->id]['offers']])->render(),
                'count'     => count($arr[$category->id]['offers']),
            ];
        }


        return view('category::frontend.categories.show', ['category' => $category->load('children'),'offers'=>$arr]);
    }
}
