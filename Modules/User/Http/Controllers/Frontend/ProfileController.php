<?php

namespace Modules\User\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\User\Http\Requests\Frontend\UpdatePasswordRequest;
use Modules\User\Http\Requests\Frontend\UpdateProfileRequest;
use Modules\User\Repositories\Frontend\UserRepository;

class ProfileController extends Controller
{
    private $user;

    function __construct(UserRepository $userRepository)
    {
        $this->user = $userRepository;
    }


    public function index()
    {
        return view('user::frontend.profile.index');
    }

    public function edit()
    {
        return view('user::frontend.profile.edit');
    }
    public function change_pass(){
        return view('user::frontend.profile.change_pass');
    }

    public function post_change_pass(UpdatePasswordRequest $request){
        auth()->user()->update($request->validated());
        return redirect()->route('frontend.profile.index')->with([
            'msg'   => __('user::api.users.updated'),
            'status'    => 'success',
        ]);
    }

    public function myOrders(Request $request)
    {
        $orders = auth()->user()->orders()->whereHas('orderItems' , function ($query) {
            $query->where('expired_date','>=',date('Y-m-d'));
        })->whereHas('orderStatus', fn($q) => $q->successPayment())->orderBy('id','desc')->get();
        return view('user::frontend.profile.my_orders', compact('orders'));
    }

    public function showOrder($id){
        $id = (int) $id;
        $order = auth()->user()->orders()->with('orderItems')->whereHas('orderStatus', fn($q) => $q->successPayment())->findOrFail($id);
        return view('user::frontend.profile.order_details', compact('order'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $this->user->update($request->validated());

        return redirect()->back()->with([
            'msg'   => __('user::api.users.updated'),
            'status'    => 'success',
        ]);
    }

    public function favourites(){
        $favourites = auth()->user()->offerFavorites;
        return view('user::frontend.profile.favourites', compact('favourites'));
    }
}
