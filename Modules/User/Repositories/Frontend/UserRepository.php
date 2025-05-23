<?php

namespace Modules\User\Repositories\Frontend;

use Modules\User\Entities\User;
use Hash;
use DB;

class UserRepository
{

    function __construct(User $user)
    {
        $this->user  = $user;
    }

    public function getAll()
    {
        return $this->user->doesntHave('company')->orderBy('id','DESC')->get();
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


        DB::beginTransaction();

        try {

            $user->update([
                'name'          => $request['name'],
                'email'         => $request['email'],
                'phone_code'    => '965',
                'mobile'        => $request['mobile'],
                'gender'        => $request['gender'],
            ]);

            if($request['birthday']){
                $user->update([
                    'birthday'      => date('Y-m-d',strtotime($request['birthday']))
                ]);
            }


            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function updateCompany($request)
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
                'phone_code'    => '965',
                'password'      => $password,
            ]);

            $company = $user->company()->where('user_id',auth()->id())->first();

            $company->update([
                'image'  => 'storage/photos/shares/logo-w.png',
                'phone'  => $request['mobile'],
            ]);

            $company->categories()->sync($request->category_id);

            $company->translateOrNew('en')->title   = $request->name;
            $company->translateOrNew('ar')->title   = $request->name;

            $company->translateOrNew('ar')->description   = $request->description;
            $company->translateOrNew('en')->description   = $request->description;
            $company->save();

            DB::commit();
            return true;

        }catch(\Exception $e){
            DB::rollback();
            throw $e;
        }
    }

    public function userProfile()
    {
        return $this->user->where('id',auth()->id())->with('company.categories')->first();
    }

    public function findById($id)
    {
        return $this->user->where('id',$id)->with('company.categories')->first();
    }
}
