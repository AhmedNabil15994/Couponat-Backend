<?php

namespace Modules\Notification\Repositories\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Core\Repositories\Dashboard\CrudRepository;
use Modules\Notification\Entities\GeneralNotification;
use Modules\User\Entities\FirebaseToken;

class NotificationRepository extends CrudRepository
{
    protected $token;

    public function __construct()
    {
        $this->token = new FirebaseToken;
        parent::__construct(GeneralNotification::class);
    }

    public function getAllFcmTokens()
    {
        return $this->token->get();
    }

    public function getAllUserTokens($userId)
    {
        return $this->token->where('user_id', $userId)->pluck('firebase_token')->toArray();
    }

    public function prepareData(array $data, Request $request, $is_create = true): array
    {
        $data['user_id'] = auth()->id();
        return $data;
    }

    public function getNotifications()
    {
        return $this->model->where([ ['is_sent',0], ['send_at','<=',date('Y-m-d H:i:s')] ])->get();
    }

    public function create(Request $request)
    {
        DB::beginTransaction();

        try {
            if ($key = array_search('null', $request->all())) {
                $request->merge([$key => null]);
            }
            // handle status attribute
            $status = $this->handleStatusInRequest($request);
            if (count($this->fileAttribute) > 0) {

                $data = $request->except(array_keys($this->fileAttribute));
            }

            if (count($status) > 0) {
                $data = array_merge($data, $status);
            }
            // call the prepareData function
            $data = $this->prepareData($data, $request, false);

            $model = $this->model->create($data);

            // call back model created
            $this->modelCreated($model, $request);

            $this->handleFileAttributeInRequest($model, $request, false);
            DB::commit();
            $this->committedAction($model, $request, "create");
            return $model;
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }
}
