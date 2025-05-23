
{!! field()->text('name',__('user::dashboard.admins.create.form.name'))!!}
{!! field()->email('email',__('user::dashboard.admins.create.form.email'))!!}
{!! field()->text('mobile',__('user::dashboard.admins.create.form.mobile'))!!}
{!! field()->password('password',__('user::dashboard.admins.create.form.password'))!!}
{!! field()->password('confirm_password',__('user::dashboard.admins.create.form.confirm_password'))!!}
{!! field()->file('image',__('user::dashboard.admins.create.form.image'),$model?$model->getFirstMediaUrl('image'):'')!!}
@if($model?->delete_reason)
    <div class="form-group">
        <div class="col-md-2">
            <label for="">{{__('user::dashboard.admins.create.form.delete_reason')}}</label>
        </div>
        <div class="col-md-9">
            <select name="delete_reason" class="form-control select2">
                @foreach(json_decode(setting('account_deletion'),true) ?? []  as $item )
                    <option value="{{$item['value']}}" {{$model->delete_reason == $item['value'] ? 'selected' : ''}}>  {{$item['value']}}</option>
                @endforeach
            </select>
        </div>
    </div>
@endif
