<?php

namespace Modules\User\Repositories\Api;

use Modules\User\Entities\Favorite;
use Modules\User\Entities\User;
use Hash;
use DB;

class UserRepository
{

    function __construct(User $user,Favorite $favourite)
    {
        $this->user  = $user;
        $this->favourite = $favourite;

    }

    public function getAll()
    {
        return $this->user->orderBy('id','DESC')->get();
    }

    public function changePassword($request)
    {
        $user = $this->findById(auth()->id());

        if ($request['password'] == null)
            $password = $user['password'];
        else
            $password  = Hash::make($request['password']);

        DB::beginTransaction();

        try {

            $user->update([
                'password'      => $password,
            ]);

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function update($request)
    {
        $user = auth()->user();

        if ($request['password'] == null)
            $password = $user['password'];
        else
            $password  = Hash::make($request['password']);

        DB::beginTransaction();

        try {

            $user->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'mobile'        => $request['mobile'],
                'calling_code'        => $request['calling_code'],
                'first_login'   => false,
                'phone_code'    => '965',
                'password'      => $password,
                'is_verified'   => $request['mobile'] != $user->mobile ? false : true,
            ]);

            $user->refresh();
            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }


    public function userProfile()
    {
        return $this->user->where('id',auth()->id())->first();
    }

    public function findById($id)
    {
        return $this->user->find($id);
    }

    public function deleteAccount()
    {
        return $this->user->find(auth()->id());
    }

    public function findFavourite($userId, $offer_id)
    {
        return $this->favourite->where(function ($q) use ($userId, $offer_id) {
            $q->where('user_id', $userId);
            $q->where('offer_id', $offer_id);
        })->first();
    }

    public function createFavourite($userId, $offer_id)
    {
        return $this->favourite->create([
            'user_id' => $userId,
            'offer_id' => $offer_id,
        ]);
    }
}
